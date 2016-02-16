<?php

/*
 * Trata o ip de retorno do wamp server, caso contrário ignora.
 */

function retornaIpCliente() {
    $ip = $_SERVER["REMOTE_ADDR"];
    //> Remove simbolos e espaços	
    if (preg_replace("/[^a-zA-Z0-9]/", "", $ip) == "1") {
        $ip = "127.0.0.1"; //> ip de retorno wamp server
    }
    return $ip;
}

/*
 * remove caracteres em branco a esquerda da string 
 * aplica o escape(\) em caracteres especiais
 * remove caracteres em branco a direta da string 
 * garante que somente a primeira letra de cada palavra fique maiuscula 
 * Ex: 
 * entrada: BRUNO mendEs lIMa
 * Saída  : Bruno Mendes Lima
 */

function retornaStringNomeDb($param_nome) {

    if (isset($param_nome)) {

        $nome = ltrim($param_nome);
        $nome = rtrim($nome);
        $nome = strtolower($nome); //Evita problemas quando há mais de uma letra maiuscula
        $nome = ucwords($nome);
        
    } else {
        $nome = null;
    }

    return $nome;
}

/*
 * remove os espaços antes e depois da string e garante que toda a string fique minuscula 
 * Ex: 
 * entrada: BRUNOmendEslIMa@Gmail.com
 * Saída  : brunomendeslima@gmail.com
 */

function retornaStringEmailDb($param_email) {

    if (isset($param_email)) {
        $email = trim(strtolower($param_email));
    } else {
        $email = null;
    }

    return $email;
}
