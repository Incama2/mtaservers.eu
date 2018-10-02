<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use Goutte;

class ServerController extends Controller
{
    public function index() {


        $all_servers = Server::all();
        $servers = [];

        foreach ($all_servers as $server) {
            array_push($servers, $server->ip);
        }

        $response = [];
        foreach ($servers as $key => $serverip) {
            $response[$serverip] = [];
            $crawler = Goutte::request('GET', 'https://www.game-state.com/' . $serverip);
            $response[$serverip]['servername'] = $crawler->filter('#hostname')->text();
            $response[$serverip]['gamemode'] = $crawler->filter('#gamemode')->text();
            $response[$serverip]['mapname'] = $crawler->filter('#mapname')->text();
            $response[$serverip]['players'] = preg_replace('{\/\d+}', '', $crawler->filter('#players')->text());
            $response[$serverip]['state'] = $crawler->filter('#state')->text();
        }

        return json_encode($response);
    }
}

// servername: Ismeretlen
// gamemode: Ismeretlen
// map: San Andreas 
// num_players: 0
// state: Online / Offline