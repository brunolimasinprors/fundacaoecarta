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


/*=======================================================================================================	
'* Efetua o envio de e-mails.
'*
'* $aryRetorno = enviaEmail("bruno.lima@sinprors.org.br", "assunto email", "<p>Mensagem do <strong>e-mail</strong></p>");
'* echo $aryRetorno["mensagem"];
'========================================================================================================*/				
function enviaEmail($para, $assunto, $mensagem) {
	/*=======================================================================================================	
	'* Ativa o formato HTML para o envio de e-mails
	'========================================================================================================*/				
	add_filter('wp_mail_content_type','set_content_type');
	
	function set_content_type($content_type){
		return 'text/html';
	}
	
	add_filter( 'phpmailer_init', 'rw_change_phpmailer_object' );
	function rw_change_phpmailer_object( $phpmailer )
	{
		$phpmailer->IsHTML(true);
	}		
	
	/*=======================================================================================================	
	'* Inicializa variáveis
	'========================================================================================================*/				
	$retorno = null;
	$strErro = null;
	
	/*=======================================================================================================	
	'* Valida os dados informados
	'========================================================================================================*/				
	if (empty($para)  && empty($strErro)) $strErro = "É obrigatório informar o <strong>destinatário do e-mail >PARA<</strong>.";				
	
	if (empty($strErro)){				
		$retorno = wp_mail($para,$assunto,$mensagem);
		
		if ($retorno){				
			return array("success" => true, "mensagem" => 'Dados enviados com sucesso.');				
		}else{
			return array("success" => false, "mensagem" => 'Erro no envio do e-mail.');									
		}
		
	}else{
		return array("success" => false, "mensagem" => utf8_encode($strErro));				
	}
}
/*========================================================================================================
'* Retorna o nome do dia da semana, por extenso, informando o id do dia da semana.
'========================================================================================================*/	
function retornaDiaSemanaPorExtenso($idDiaSemana){
	$aryDiaSemanaPorExtenso = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", 
"Sábado");			
	return $aryDiaSemanaPorExtenso[$idDiaSemana];
}


/*=======================================================================================================	
'* Retorna o nome do mês, por extenso, informando o id do mês.
'========================================================================================================*/	
function retornaMesPorExtenso($idMes){
	$aryMesesPorExtenso = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");		
	return $aryMesesPorExtenso[$idMes];
}
