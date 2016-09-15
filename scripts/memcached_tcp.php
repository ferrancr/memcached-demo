#!/usr/local/bin/php -q
<?php

function memcache_msg($socket,$msg ) {
    echo "peticion:\n$msg";
    socket_write($socket, $msg, strlen($msg));
    $buf = socket_read($socket, 2048);
    echo "respuesta:\n$buf";
    return $buf;
}

error_reporting(E_ALL);

echo "TCP/IP Connection\n";

/* Obtener el puerto para el servicio WWW. */
$service_port = 11211;

/* Obtener la dirección IP para el host objetivo. */
$addresses = array("10.1.1.101","10.2.2.102","10.3.3.103");

foreach ($addresses as $address ) {
    /* Crear un socket TCP/IP. */
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
        continue;
    } else {
        echo "OK.\n";
    }

    echo "Intentando conectar a '$address' en el puerto '$service_port'...";
    $result = socket_connect($socket, $address, $service_port);
    if ($result === false) {
        echo "socket_connect() falló.\nRazón: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
        continue;
    } else {
        echo "OK.\n";
    }
    $buf = memcache_msg($socket,"set Test 0 100 10\r\n1234567890\r\n");
    if (trim($buf) == "STORED") {
        echo "OK.\n";
        memcache_msg($socket,"get Test\n");
    } else {
        echo "set falló. No ha sido guardado!!!";
    }
    echo "Cerrando socket...\n";
    socket_close($socket);
}
