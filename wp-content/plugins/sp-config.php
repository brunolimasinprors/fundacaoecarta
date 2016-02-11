<?php

/**
 * ##########################################################################################################
 * ################# Configurações especificas customizações wordpress Sinpro/RS ############################
 * ##########################################################################################################
 */
/* -----------------------------------------------------------------------------------------------------	
  '* 						MÓDULO DE AUTENTICAÇÃO AD (ACTIVE DIRECTORY)
  '------------------------------------------------------------------------------------------------------- */

/* -----------------------------------------------------------------------------------------------------	
'* Relação de Grupos AD permitidos, com suas repectivas permissões a serem aplicadas no wordpress
'------------------------------------------------------------------------------------------------------- */

$aryGruposPermitidos[0] [0] = "TI"; //> AD (Active Directory)
$aryGruposPermitidos[0] [1] = "administrator";  //> Quando o usuário pertencer ao grupo <TI> aplicar o grupo <administrator> no Wordpress

$aryGruposPermitidos[1] [0] = "ECARTA"; //> AD (Active Directory)
$aryGruposPermitidos[1] [1] = "editor"; //> Quando o usuário pertencer ao grupo <ECARTA> aplicar o grupo <author> no Wordpress

define('GRUPOS_PERMITIDOS', serialize($aryGruposPermitidos));

/** Padrão de endereçamento aplicado na intranet do Sinpro/RS */
define('INICIO_IP_INTRANET', '192.168.');

define('URL_INTERNA_INTRANET', 'http://intranet.sinprors.org.br/');
define('URL_EXTERNA_INTRANET', 'http://intranet.sinprors.org.br/');
//define('URL_EXTERNA_INTRANET', 'http://sinprors.ddns.info:8888/');

define('COPYRIGHT_INFO', '© Copyright 2016, Fundação Ecarta - Todos os direitos reservados.');

if (defined('WP_SITEURL') && '' != WP_SITEURL) {
    //echo WP_SITEURL; 
} else {
    define('WP_SITEURL', get_site_url());
}

/* -----------------------------------------------------------------------------------------------------	
'* Token de identificação da aplicação
'------------------------------------------------------------------------------------------------------- */
define('TOKEN_APLICACAO', 'z45O5y6655u87778r');

/* -----------------------------------------------------------------------------------------------------	
'* Areas de conteúdo
'------------------------------------------------------------------------------------------------------- */
$arySlugAreasConteudo[] = "agenda"; 
$arySlugAreasConteudo[] = "noticias"; 
$arySlugAreasConteudo[] = "artigos"; 
$arySlugAreasConteudo[] = "historico"; 


define('SLUG_AREAS_CONTEUDO', serialize($arySlugAreasConteudo));


?>