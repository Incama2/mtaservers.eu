<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\OnlinePlayer;
use Goutte;

class ServerController extends Controller
{
    public function index() {
        $all_servers = Server::all();
        $response = [];

        foreach ($all_servers as $server) {
            $response[$server->ip] = [];
            $crawler = Goutte::request('GET', 'https://www.game-state.com/' . $server->ip);
            $response[$server->ip]['servername'] = $crawler->filter('#hostname')->text();
            $response[$server->ip]['gamemode'] = $crawler->filter('#gamemode')->text();
            $response[$server->ip]['mapname'] = $crawler->filter('#mapname')->text();
            $response[$server->ip]['state'] = $crawler->filter('#state')->text();
            $response[$server->ip]['players'] = OnlinePlayer::where('serverID', $server->id)->take(100)->orderBy('date', 'ASC')->get(['count', 'date']);
        }

        return response()->json([
            "response" => $response
        ], 200);
    }
}

// servername: Ismeretlen
// gamemode: Ismeretlen
// map: San Andreas 
// num_players: 0
// state: Online / Offline