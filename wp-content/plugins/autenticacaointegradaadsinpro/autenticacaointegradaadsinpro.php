<?php
	/*
	Plugin Name: Autenticação Integrada AD (Sinpro/RS)
	Plugin URI: 
	Description: Valida as credencias dos usuários através da página |autenticaAplicacaoAd.asp| que integra o AD (Active Directory) do Sinpro/RS.
	Version: 1.0
	Author: Lucas Emerim Marques
	Author URI: 
	License: GPLv2
	*/

	/*-----------------------------------------------------------------------------------------------------	
	'*
	'* 	Efetuada a autenticação dos usuários através da página intermediária de validação das credenciais no 
	'* 	AD (Active Directory) do Sinpro/RS <autenticaAplicacaoAd.asp>.  Esta página está na intranet do Sinpro/RS, 
	'* 	uma vez que a intranet não estiver acessível a autenticação é efetuada diretamente pela base de dados de 
	'* 	usuários do wordpress. A cada autenticação no AD é atualizado os dados dos usuários na base de dados do 
	'* 	wordpress, mantendo assim uma cópia fiel dos dados do usuário no wordpress.
	'*
	'-------------------------------------------------------------------------------------------------------*/				

class autenticacaoIntegradaADSinpro {	 
	
	private static $wpdb;
	public static $retornoAcessoRemoto;
	public static $grupoWordPressUsuario;
	private static $mensagemRetornoOperacao;


	/**
	 * Metodo de inicialização
	 *
	 */
	public static function inicializar(){
		
	 
		/*=======================================================================================================	
		'* Inclui arquivo de configurações globais
		'========================================================================================================*/				
		include_once(ABSPATH."wp-content/plugins/sp-config.php");
		                    
		global $wpdb;
				
		//> Altera o processo de autenticação		
		/*-----------------------------------------------------------------------------------------------------	
		'* Aplica o gatilho de alteração do processo de autenticação
		'* 	Executa o metodo <autenticar> da classe <autenticacaoIntegradaADSinpro>
		'-------------------------------------------------------------------------------------------------------*/				
		add_filter("authenticate", array("autenticacaoIntegradaADSinpro", "autenticar"), 10, 3);
		
		//> Mapear objetos WP
		autenticacaoIntegradaADSinpro::$wpdb = $wpdb;

	}



	/*=======================================================================================================	
	'* ###> Retorna a URL de acesso a intranet do Sinpro/RS para atenticação no AD, de acordo com a localização 
	'*      do computador cliente.
	'========================================================================================================*/				
	public static function retornaUrlAcessoIntranetSinpro(){

		/*-----------------------------------------------------------------------------------------------------	
		'* Retorna o número do IP do computador cliente
		'-------------------------------------------------------------------------------------------------------*/				
		$ip = retornaIpCliente();
		
		/*-----------------------------------------------------------------------------------------------------	
		'* Identifica se o acesso é interno (intranet) ou externo(extranet), aplicando o endereço equivalente	
		'* a localização.
		'-------------------------------------------------------------------------------------------------------*/				
		if (strstr($ip, INICIO_IP_INTRANET) || strstr($ip, "127.0.0.1")){ //> Acesso interno
			$servidor = URL_INTERNA_INTRANET."sistemas/autenticaAplicacaoAd.asp";
		}else{ //> Acesso Externo
			$servidor = URL_EXTERNA_INTRANET."sistemas/autenticaAplicacaoAd.asp";
		}

		//> ##### Teste Comentar
		//$servidor = URL_INTERNA_INTRANET."sistemas/autenticaAplicacaoAd.asp";

		return $servidor;
		
	}

	/*=======================================================================================================	
	'* ###> Valida a disponibilidade de acesso ao endereço <url>
	'========================================================================================================*/				
	public static function validaDisponibilidadeAcessoUrlIntranetSinpro($user, $username, $password){
		
		//> Inicializa
		$acessoRemoto = curl_init();
	
		//> URL
		$urlAcessoIntranetSinpro = autenticacaoIntegradaADSinpro::retornaUrlAcessoIntranetSinpro();
		
		curl_setopt($acessoRemoto, CURLOPT_URL, $urlAcessoIntranetSinpro);	
		//> Retornar o Resultado
		curl_setopt($acessoRemoto, CURLOPT_RETURNTRANSFER, true);
		//> método de envio <POST>
		curl_setopt($acessoRemoto, CURLOPT_POST, true);
	
		$dadosCampos = "strUsuario=".$username."&strSenha=".$password."&strTokenAplicacao=".TOKEN_APLICACAO;
		
		//> Campos
		curl_setopt($acessoRemoto, CURLOPT_POSTFIELDS, $dadosCampos);
		
		//> Envia os dados
		self::$retornoAcessoRemoto = curl_exec($acessoRemoto);

		//> Recebe o código de resposta HTTP
		$resposta = curl_getinfo($acessoRemoto, CURLINFO_HTTP_CODE);

		
		if ($resposta == '200') { //200: Success
			return true; 
		}else{
			//echo $urlAcessoIntranetSinpro;
			return false; //> Acesso indiponivel	
			//$msgErro = "O site está fora do ar (ERRO 404)!";
		}
	}



	/*=======================================================================================================	
	'* ###> Atentica os usuários no AD ou diretamente no Wordpress
	'========================================================================================================*/				
	public static function autenticar($user, $username, $password){

		

		/*=======================================================================================================	
		'* Quando (usuário e a senha) não for informado.
		'========================================================================================================*/				
		if (empty($username) && empty($password)){				
			return false;
		}


		/*=======================================================================================================	
		'* Valida disponibilidade de acesso a intranet do Sinpro/RS, para autenticação via AD(Active Directory)
		'========================================================================================================*/				
		$retornoDisponibilidade = autenticacaoIntegradaADSinpro::validaDisponibilidadeAcessoUrlIntranetSinpro($user, $username, $password);		


		if ($retornoDisponibilidade == true){
			/*-----------------------------------------------------------------------------------------------------	
			'* Valida credenciais diretamente no AD (Active Directory) Intranet Sinpro/RS
			'-------------------------------------------------------------------------------------------------------*/		
			$retornoAutenticacao = autenticacaoIntegradaADSinpro::autenticarADSinpro();


			if ($retornoAutenticacao == true){
				/*-----------------------------------------------------------------------------------------------------	
				'* Verifica a existência do usuário no wordpress
				'-------------------------------------------------------------------------------------------------------*/					
				$objUsuario =  get_user_by('login', $username);

				/*-----------------------------------------------------------------------------------------------------	
				'* Quando o usuário não existir na base do wordpresss
				'-------------------------------------------------------------------------------------------------------*/					
				if (!$objUsuario){ 

					/*-----------------------------------------------------------------------------------------------------	
					'* Inclui usuário wordpress, quando não existir
					'-------------------------------------------------------------------------------------------------------*/					
					return autenticacaoIntegradaADSinpro::incluirUsuarioWp($user, $username, $password);
	
	
				}else{ //> if ($objUsuario)

					/*-----------------------------------------------------------------------------------------------------	
					'* Quando o usuário já existir na base de dados do Worpdress
					'* 	1) Verifica a existência de alteração dos dados.					
					'*  2) Quando existir alteração, atualiza os dados do usuário.
					'-------------------------------------------------------------------------------------------------------*/	
					return autenticacaoIntegradaADSinpro::alterarUsuarioWp($user, $username, $password);					
					
					
				} // if (!get_user_by('login', $username)){ 
				
				
			}else{ //> if ($retornoAutenticacao == false){
				/*-----------------------------------------------------------------------------------------------------	
				'* Seta erro retornado na tentativa de autenticação AD intranet Sinpro/RS
				'-------------------------------------------------------------------------------------------------------*/		
				return new WP_Error('authentication_failed', __('<strong>ERRO</strong>: '.self::$mensagemRetornoOperacao));
			}
			
			
		}else{
			/*-----------------------------------------------------------------------------------------------------	
			'* Aplica autenticação do Wordpress
			'-------------------------------------------------------------------------------------------------------*/		

		}


			
		
	}

	/*=======================================================================================================	
	'* ###> Insere usuário no Wordpress
	'========================================================================================================*/				
	public static function incluirUsuarioWp($user, $username, $password){

		$jsonDecode = json_decode(autenticacaoIntegradaADSinpro::$retornoAcessoRemoto);				
	
		$dadosUsuario = array(
			'user_pass'     => $password,
			'user_login'    => $username,
			'user_email'    => utf8_decode($jsonDecode->{'email'}),
			'display_name'  => utf8_decode($jsonDecode->{'nome'}),
			'nickname'      => utf8_decode($jsonDecode->{'primeironome'}),
			'first_name'    => utf8_decode($jsonDecode->{'primeironome'}),
			'last_name'     => utf8_decode($jsonDecode->{'sobrenome'}),
			'role'          => self::$grupoWordPressUsuario,
		);

	
		/*-----------------------------------------------------------------------------------------------------	
		'* Insere novo usuário Wordpress
		'-------------------------------------------------------------------------------------------------------*/		
		$userId = wp_insert_user($dadosUsuario);
	
		/*-----------------------------------------------------------------------------------------------------	
		'* Valida a ocorrêrncia de erro na inserção
		'-------------------------------------------------------------------------------------------------------*/		
		if(is_wp_error($userId)){
	
			/*-----------------------------------------------------------------------------------------------------	
			'* Retorna o erro
			'-------------------------------------------------------------------------------------------------------*/		
			$error = new WP_Error();
			$error->add('empty_username', __($userId->get_error_message()));

			return $error;
	
		}else{
			/*-----------------------------------------------------------------------------------------------------	
			'* Retorna os dados do usuário
			'-------------------------------------------------------------------------------------------------------*/		
			$objUsuario =  get_user_by('login', $username);

			/*-----------------------------------------------------------------------------------------------------	
			'* Quando a inserção do novo usuário for bem sucedida
			'-------------------------------------------------------------------------------------------------------*/		
			return new WP_User($objUsuario->ID);
		}
	}



	/*=======================================================================================================	
	'* ###> Atualiza dados usuário na base de dados do Wordpress
	'========================================================================================================*/				
	public static function alterarUsuarioWp($user, $username, $password){
		
		/* Retorna os dados AD Intranet */
		$jsonDecode = json_decode(autenticacaoIntegradaADSinpro::$retornoAcessoRemoto);						
		
		/*-----------------------------------------------------------------------------------------------------	
		'* Retorna os dados do usuário
		'-------------------------------------------------------------------------------------------------------*/		
		$objUsuario =  get_user_by('login', $username);

		if ($objUsuario){ 
			/*-----------------------------------------------------------------------------------------------------	
			'* Atualiza os dados do usuário
			'-------------------------------------------------------------------------------------------------------*/		
				
			$dadosUsuario = array(
				'ID' => $objUsuario->ID,				  
				'user_pass'     => $password,
				'user_login'    => $username,
				'user_email'    => utf8_decode($jsonDecode->{'email'}),
				'display_name'  => utf8_decode($jsonDecode->{'nome'}),
				'nickname'      => utf8_decode($jsonDecode->{'primeironome'}),
				'first_name'    => utf8_decode($jsonDecode->{'primeironome'}),
				'last_name'     => utf8_decode($jsonDecode->{'sobrenome'}),
				'role'          => self::$grupoWordPressUsuario,
			);

		
			/*-----------------------------------------------------------------------------------------------------	
			'* Insere novo usuário Wordpress
			'-------------------------------------------------------------------------------------------------------*/		
			$userId = wp_update_user($dadosUsuario);
		
			/*-----------------------------------------------------------------------------------------------------	
			'* Valida a ocorrêrncia de erro na inserção
			'-------------------------------------------------------------------------------------------------------*/		
			if(is_wp_error($userId)){
		
				/*-----------------------------------------------------------------------------------------------------	
				'* Retorna o erro ocorrido na atualização do usuário
				'-------------------------------------------------------------------------------------------------------*/		
				$error = new WP_Error();
				$error->add('empty_username', __($userId->get_error_message()));
				return $error;
		
			}else{ // !is_wp_error($userId)
				/*-----------------------------------------------------------------------------------------------------	
				'* Quando a atualização do usuário for bem sucedida
				'-------------------------------------------------------------------------------------------------------*/		
				return new WP_User($objUsuario->ID);
				//echo "Dados Atualizados";
			}
				

		}else{ // if (!$objUsuario){
			/*-----------------------------------------------------------------------------------------------------	
			'* Retorna o erro
			'-------------------------------------------------------------------------------------------------------*/		
			$error = new WP_Error();
			$error->add('empty_username', __("Usuário não localizado no wordpress."));
			return $error;
			
		}
	}






	/*=======================================================================================================	
	'* ###> Atentica os usuários no AD
	'========================================================================================================*/				
	public static function autenticarADSinpro(){

		/*-----------------------------------------------------------------------------------------------------	
		'* Remove o padrão de autenticação do wordpress
		'-------------------------------------------------------------------------------------------------------*/		
		remove_filter('authenticate', 'wp_authenticate_username_password', 20, 3);


		$flegAchou = false;		
		$jsonDecode = json_decode(autenticacaoIntegradaADSinpro::$retornoAcessoRemoto);

		

		if ($jsonDecode->{'autenticado'} == true){
			$aryGruposUsuario = $jsonDecode->{'grupos'};
			
			$aryGruposPermitidos = unserialize(GRUPOS_PERMITIDOS);
			
			/*-----------------------------------------------------------------------------------------------------	
			'* Verifica se o usuário possui permissão de acesso de acordo com seus grupos definidos no <AD>	
			'-------------------------------------------------------------------------------------------------------*/		
			for ($iCount = 0; $iCount < sizeof($aryGruposUsuario); $iCount ++) {
				for ($iCountInterno = 0; $iCountInterno < sizeof($aryGruposPermitidos); $iCountInterno ++) {
					if (strtoupper($aryGruposUsuario[$iCount]) == strtoupper($aryGruposPermitidos[$iCountInterno] [0])){
						$flegAchou = true;
						self::$grupoWordPressUsuario = $aryGruposPermitidos[$iCountInterno] [1];
						break;
					}
				}
			}
		}else{
			self::$mensagemRetornoOperacao = utf8_decode($jsonDecode->{'mensagemretorno'});						
		}
			
		if ($flegAchou == true){		
			return true;	
		}else{
			if (empty(self::$mensagemRetornoOperacao)){
				self::$mensagemRetornoOperacao = "O usuário não possui permissão para acessar o sistema.";				
			}
			return false;
		}

	}




	/*=======================================================================================================	
	'* ###> Função de instalação e ativação do plugin
	'========================================================================================================*/				
	public static function instalar(){

		if ( is_null(autenticacaoIntegradaADSinpro::$wpdb) ) autenticacaoIntegradaADSinpro::inicializar();
		
		//Criar opções
		add_option('Autenticacao_Integrada_AD_Sinpro', 'Version 1.0');		
		
	}
	
	public static function desinstalar(){
		
		//Remover opções
		delete_option("Autenticacao_Integrada_AD_Sinpro");
	}
	
	
	
}

$spPluginFile = substr(strrchr(dirname(__FILE__),DIRECTORY_SEPARATOR),1).DIRECTORY_SEPARATOR.basename(__FILE__);
//echo $mppPluginFile;

/** Instalação  */
register_activation_hook($spPluginFile,array('autenticacaoIntegradaADSinpro','instalar'));

//** desinstalar
register_deactivation_hook($spPluginFile,array('autenticacaoIntegradaADSinpro','desinstalar'));


/** Inicializacão */
add_filter('init', array('autenticacaoIntegradaADSinpro','inicializar'));



?>