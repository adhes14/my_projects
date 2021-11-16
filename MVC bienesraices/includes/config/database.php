<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'adheduran', 'adheduran123', 'bienesraices_crud');
    // $db = new mysqli('198.199.122.101', 'adhemar', '', 'testhvt', '3306');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}