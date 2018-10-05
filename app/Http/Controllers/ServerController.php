<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\OnlinePlayer;
use Goutte;

class ServerController extends Controller
{

    public function index() {
        $response = [];
        
        $all_servers = Server::all();
        foreach ($all_servers as $server) {
            $crawler = Goutte::request('GET', 'https://www.game-state.com/' . $server->ip);
            if ($crawler->filter('#hostname')->text() && $crawler->filter('#gamemode')->text() && $crawler->filter('#mapname')->text() && $crawler->filter('#state')->text() && OnlinePlayer::where('serverID', $server->id)->first()) {
                $response[$server->ip] = [];
                $response[$server->ip]['servername'] = $crawler->filter('#hostname')->text();
                $response[$server->ip]['gamemode'] = $crawler->filter('#gamemode')->text();
                $response[$server->ip]['mapname'] = $crawler->filter('#mapname')->text();
                $response[$server->ip]['state'] = $crawler->filter('#state')->text();
                $response[$server->ip]['players'] = OnlinePlayer::where('serverID', $server->id)->take(100)->orderBy('date', 'ASC')->get(['count', 'date']);

            };
        };
        return response()->json([
            "response" => $response
        ], 200);
    }

    public function new(Request $request)
    {
        $crawler = Goutte::request('GET', 'https://www.game-state.com/' . $request->new_server_ip);
        if($crawler) {
            // Lecsekkoljuk hogy benne van e már az adatbázisban
            if(Server::where('ip', $request->new_server_ip)->first()) {
                return response()->json([
                    'errors' => 'Már van ilyen szerver.'
                ], 404);
            }


            $req = new Server;
            $req->ip = $request->new_server_ip;
            $req->save();

            $response[$request->new_server_ip]['servername'] = $crawler->filter('#hostname')->text();
            $response[$request->new_server_ip]['gamemode'] = $crawler->filter('#gamemode')->text();
            $response[$request->new_server_ip]['mapname'] = $crawler->filter('#mapname')->text();
            $response[$request->new_server_ip]['state'] = $crawler->filter('#state')->text();
            $response[$request->new_server_ip]['players'] = [];
            
            return response()->json([
                "response" => $response
            ], 200);
        };

        return response()->json([
            'errors' => 'Nem található'
        ], 404);

    }

}

// servername: Ismeretlen
// gamemode: Ismeretlen
// map: San Andreas 
// num_players: 0
// state: Online / Offline