<?php

    /*
     * Trata o ip de retorno do wamp server, caso contrário ignora.
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016
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
     * Efetua o envio de e-mails.
     * $aryRetorno = enviaEmail("bruno.lima@sinprors.org.br", "assunto email", "<p>Mensagem do <strong>e-mail</strong></p>");
     * 
     * @author Bruno Mendes Lima
     * @version 23/02/2016
    */
    function enviaEmail($para, $assunto, $mensagem) {
        /* =======================================================================================================	
          '* Ativa o formato HTML para o envio de e-mails
          '======================================================================================================== */
        add_filter('wp_mail_content_type', 'set_content_type');

        function set_content_type($content_type) {
            return 'text/html';
        }

        add_filter('phpmailer_init', 'rw_change_phpmailer_object');

        function rw_change_phpmailer_object($phpmailer) {
            $phpmailer->IsHTML(true);
        }

        /* =======================================================================================================	
          '* Inicializa variáveis
          '======================================================================================================== */
        $retorno = null;
        $strErro = null;

        /* =======================================================================================================	
          '* Valida os dados informados
          '======================================================================================================== */
        if (empty($para) && empty($strErro))
            $strErro = "É obrigatório informar o <strong>destinatário do e-mail >PARA<</strong>.";

        if (empty($strErro)) {
            $retorno = wp_mail($para, $assunto, $mensagem);

            if ($retorno) {
                return array("success" => true, "mensagem" => 'Dados enviados com sucesso.');
            } else {
                return array("success" => false, "mensagem" => 'Erro no envio do e-mail.');
            }
        } else {
            return array("success" => false, "mensagem" => utf8_encode($strErro));
        }
    }

    /*
     * Retorna a descrição do dia da semana, por extenso, informando o id do dia da semana.     
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016
    */    
    function retornaDiaSemanaPorExtenso($idDiaSemana){
        $aryDiaSemanaPorExtenso = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", 
"Sábado");			
        return $aryDiaSemanaPorExtenso[$idDiaSemana];
    }

    /*
     * Retorna o nome do mês, por extenso, informando o id do mês.
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016
    */    
    function retornaMesPorExtenso($idMes) {
        $aryMesesPorExtenso = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
        return $aryMesesPorExtenso[$idMes];
    }

    /*
     * Retorna as palavras chaves no formato correto para indexação do google.
     * 
     * @author Bruno Mendes Lima
     * @version 25/02/2016
    */    
    function formataPalavrasChave($param_string, $separador = '') {
        $resultado = $param_string;
        //caso exista um separador, adiciona o espaço a esquerda
        if (!empty($separador)) {
            $arrPontuacao = array('.', ';', ':', "'", ',');
            //garante que apenas o separador seja utilizado    
            foreach ($arrPontuacao as $pontuacao) {
                if ($separador !== $pontuacao) {
                    $resultado = str_replace($pontuacao, $separador, $resultado);
                }
            }
            $resultado = trim(preg_replace('/' . $separador . '+/', $separador . ' ', $resultado));
        }
        //garante que existirá apenas um único espaço entre cada caractere.
        $resultado = trim(preg_replace('/ +/', ' ', $resultado));
        return $resultado; 
    }
    