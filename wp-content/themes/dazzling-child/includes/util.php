<?php

/* 
 * Trata o ip de retorno do wamp server, caso contrário ignora.
 */
function retornaIpCliente() {	
    $ip = $_SERVER["REMOTE_ADDR"];
    //> Remove simbolos e espaços	
    if (preg_replace("/[^a-zA-Z0-9]/", "", $ip) == "1"){
            $ip = "127.0.0.1"; //> ip de retorno wamp server
    }   
    return $ip;
}

