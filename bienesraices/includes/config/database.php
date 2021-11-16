<?php

function conectarDB() : mysqli {
    // $db = new mysqli('localhost', 'adheduran', 'adheduran123', 'testhvt');
    $db = new mysqli('198.199.122.101', 'adhemar', 'hivetenadhemar', 'testhvt');


    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}