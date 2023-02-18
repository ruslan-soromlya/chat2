<?php

use OpenSwoole\WebSocket\Server;
use OpenSwoole\Http\Request;
use OpenSwoole\WebSocket\Frame;

$server = new Server("0.0.0.0", 8888);

$server->on("Start", function(Server $server)
{
    echo "OpenSwoole WebSocket Server is started at http://127.0.0.1:8888\n";

});

$server->on('Open', function(Server $server, OpenSwoole\Http\Request $request) {
    echo "connection open: {$request->fd}\n"; 
});

$server->on('Message', function(Server $server, Frame $frame) {
    foreach($server->connections as $fd) {
        $server->push($fd, $frame->data);
    }
});

$server->start();