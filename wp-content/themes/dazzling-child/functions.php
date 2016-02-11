<?php
/**
 * Dazzling functions and definitions
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
 
include(ABSPATH."wp-content/plugins/sp-config.php");
include(get_stylesheet_directory() . "/includes/extras.php");
include(get_stylesheet_directory() . "/includes/complementar.php");



/*======================================================================
'* TELA DE LOGIN
'*
'* DESCRIÇÃO: CUSTOMIZA O LINK DO LOGO DA PÁGINA DE LOGIN DO WORDPRESS
'*======================================================================*/
if ( ! function_exists( 'define_url_logo_tela_login' ) ) {
	function define_url_logo_tela_login(){
		return get_bloginfo('url');  //> Retorna a url do site
	}
	add_filter('login_headerurl', 'define_url_logo_tela_login'); //> Gatinho
}


/*======================================================================
'* TELA DE LOGIN
'*
'* DESCRIÇÃO: CUSTOMIZA O TÍTULO DA PÁGINA DE LOGIN DO WORDPRESS
'*======================================================================*/
if ( ! function_exists( 'define_title_logo_tela_login' ) ) {
	function define_title_logo_tela_login(){
		return 'Abre o site do ' . get_option('blogname'); //> Retorna o Título
	}
	add_filter('login_headertitle', 'define_title_logo_tela_login'); //> Gatinho
}

/*======================================================================
'* TELA DE LOGIN
'*
'* DESCRIÇÃO: CUSTOMIZA O LOGO DA PÁGINA DE LOGIN DO WORDPRESS
'*======================================================================*/
if ( ! function_exists( 'define_imagem_logo_tela_login' ) ) {
	function define_imagem_logo_tela_login(){
		echo '<style  type="text/css"> h1 a {  background-image:url(' . get_bloginfo('template_directory').'-child/imagens/wordpress-logo.png)  !important; background-size: 312px 67px !important; width: 312px !important; height: 67px !important; } </style>';
	}
	add_action('login_head',  'define_imagem_logo_tela_login');	//> Gatinho
}


/*======================================================================
'* PAINEL DE CONTROLE
'*
'* DESCRIÇÃO: CUSTOMIZA A INFORMAÇÃO DO RODAPÉ DA TELA DE ADMINISTRAÇÃO
'*======================================================================*/
if ( ! function_exists( 'define_rodape_tela_admin' ) ) {
	function define_rodape_tela_admin (){
		return '<span id="footer-thankyou">Desenvolvido por <a href="http://www.cwi.com.br" target="_blank">CWI Software</a> e equipe TI SINPRO/RS</span>';
	}
	add_filter('admin_footer_text', 'define_rodape_tela_admin');
}



/*=======================================================================================================	
'* Retorna o título da imagem a ser exibida no padrão estabelecido.
'*
'* 		Padrão : título da imagem | nome do fotografo
'*		Exemplo: Negociação coletiva 2010 | Igor Sperotto 
'========================================================================================================*/	
if ( ! function_exists( 'retornaPadraoTituloImagem' ) ) {

	function retornaPadraoTituloImagem($aryDados) {
		//> Nome do fotografo da imagem
		 $aryDadosPluginISC = get_post_meta($aryDados["id"], 'isc_image_source', false);
		 
		 $separador = "";
		 if (!empty($aryDadosPluginISC[0]) && !empty($aryDados["title"])) {
			$separador = " | ";		
		 }
		 
		return $aryDados["title"].$separador.$aryDadosPluginISC[0];
	}
}

function retornaLayoutCategoriaPrincipal($pIdCategoria){
	
	$args = array(
		'type'                     => 'post',								
		'orderby'                  => 'id',
		'order'                    => 'ASC',
		'hide_empty'               => 0, /* Exibe todos os projetos, mesmo sem posts vinculados */								
		'include'                  => $pIdCategoria
	); 

	$categories = get_categories($args);	
	
	if ($categories) {
		foreach($categories as $term) {																
			$aryDados["cor"] = get_field('cor_projeto_area', 'category_'.$term->term_id);
			$aryDados["imagem"] = get_field('logo_projeto_area', 'category_'.$term->term_id);
			$aryDados["titulo"] = $term->name;
			$aryDados["slug"] = $term->slug;
			
			//> Retorna os estilos css da <<categoria>>
			if (!empty($aryDados["cor"])){
				$aryDados["color_css"] = $term->slug."_color";			
				$aryDados["border-color_css"] = $term->slug."_border-color";
				$aryDados["background-color_css"] = $term->slug."_background-color";
			}else{
				$aryDados["color_css"] = "categoria_padrao_color";			
				$aryDados["border-color_css"] = "categoria_padrao_border-color";
				$aryDados["background-color_css"] = "categoria_padrao_background-color";
			}
			
			
			
			return $aryDados;				
	  }
	
	}
	
	return null;
	
}

function retornaIdCategoriaPrincipal($pAryCategorias){
	
	$idCategoriaParcerias = get_cat_ID("parcerias");
	if (in_array($idCategoriaParcerias, $pAryCategorias)){
		return $idCategoriaParcerias;	
	}	
	
	$idCategoriaFundacao = get_cat_ID("a fundação");	
	if (in_array($idCategoriaFundacao, $pAryCategorias)){
		return $idCategoriaFundacao;	
	}

	$idCategoriaProjetos = get_cat_ID("projetos");

		
	$args = array(
		'hide_empty'               => 0, /* Exibe todos os projetos, mesmo sem posts vinculados */								
		'parent'                  => $idCategoriaProjetos /* Exibe as categorias filhas de projeto */
	); 
	
	$aryCategorias = get_categories($args);	
	
	//$aryCategorias = get_category_parents($idCategoriaProjetos, true);	
	//print_r($aryCategorias);
	foreach($aryCategorias as $aryCategoria){
		if (in_array($aryCategoria->term_id, $pAryCategorias)){
			return $aryCategoria->term_id;			
		}
		
	}
	
	
	
	
	//> Verifica da Categoria <Parceiros> na relação de categorias do post
	//if (in_array($idCategoriaParcerias, $aryCategoriasPost)){
	//	return $aryCategoria->term_id;
	//}

	
	
	return null;	
	
}


function retornaIdCategoriaPrincipalPost($pIdPost){
	//> Retorna ids categoria post
	$aryCategoriasPost = wp_get_post_categories($pIdPost);
	
	return retornaIdCategoriaPrincipal($aryCategoriasPost);
	
	
	//> retorna o ids das categorias a serem verificadas
	
	//$aryCategoriasPost = wp_get_post_categories($idPost);

	
	//$idCategoriaFilha/
	
	
	
	
	
	//> Retorna ids categorias filhas de <<projetos>>
	
	//> Retorna id categoria <parcerias>
}


/*=======================================================================================================	
'* Retorna a relação de ids das categorias complementares existente na url acessada. 
'* Não retorna o id das categorias principais (Exclusivo Web, Edições).
'========================================================================================================*/		
function retornaIdsCategoriasUrlAcessada(){
	
	//> Retorna url base do site
	$urlBaseSite = get_bloginfo('url');	 //> Retorna Url Base do Site
	
	//> Retorna Url atual acessada
	$urlAcessada = "http://".retornaUrlAtual(); 

	//> Retorna apenas o complemento da url base
	$complementoUrl = str_replace($urlBaseSite, "", $urlAcessada);
	
	//> array complemento da url
	$aryComplementoUrl = explode('/', $complementoUrl); //> Split o <path> na ocorrencia de </> para verificação

	$args = array(
		'hide_empty'                 => 0, //> Retorna categorias sem post relacionados
		'orderby'                  => 'name',
		'order'                    => 'ASC',
	); 
	$postcategory = get_categories($args);	

	$aryIdsCategorias = array();

	//print_r($postcategory);

	if ($postcategory) {
		/*=======================================================================================================	
		'* Verifica a existência de tags, na url acessada.
		'========================================================================================================*/		
	  foreach($postcategory as $category) {		  
		if (in_array($category->slug, $aryComplementoUrl)){
			$aryIdsCategorias[] = $category->term_id;
		}
	  }
	}	


	
	
	return $aryIdsCategorias;
	//return null;
}

/*=======================================================================================================	
'* Retorna url complementar categorias acessada
'*
'========================================================================================================*/		
function retornaUrlComplementarCategorias(){
	
	//> Retorna url base do site
	$urlBaseSite = get_bloginfo('url');	 //> Retorna Url Base do Site
	
	//> Retorna Url atual acessada
	$urlAcessada = "http://".retornaUrlAtual(); 

	//> Retorna apenas o complemento da url base
	$complementoUrl = str_replace($urlBaseSite, "", $urlAcessada);
	
	//> array complemento da url
	$aryComplementoUrl = explode('/', $complementoUrl); //> Split o <path> na ocorrencia de </> para verificação

	$args = array(
		'hide_empty'                 => 0, //> Retorna categorias sem post relacionados
		'orderby'                  => 'name',
		'order'                    => 'ASC',
	); 
	$postcategory = get_categories($args);	

	//echo "<pre>";
	//print_r($postcategory);
	//echo "</pre>";
	if ($postcategory) {
		/*=======================================================================================================	
		'* Verifica a existência de tags, na url acessada.
		'========================================================================================================*/				
		$aryCategory = array();	
		foreach($postcategory as $category) {
			array_push($aryCategory, $category->slug);		  
		}
		
		$urlComplementarCategoria = null;	
		foreach($aryComplementoUrl as $complementoUrl) {		
			if (in_array($complementoUrl, $aryCategory)){
				$urlComplementarCategoria .= $complementoUrl."/"; 		 
			}
		} //> foreach($aryComplementoUrl as $complementoUrl) {				
	} //> if ($postcategory) {	

	if (!empty($urlComplementarCategoria)){
		$urlComplementarCategoria = "/".$urlComplementarCategoria;
	}

	
	
	return $urlComplementarCategoria;
	//return null;
}




/*=================================================================================================================	
'* Retorna a url atual acessada
'=================================================================================================================*/
function retornaUrlAtual(){
	$server = $_SERVER['SERVER_NAME']; 
	$endereco = $_SERVER ['REQUEST_URI'];
	if (!empty($endereco)){
		return $server.$endereco;
	}else{
		return $server;			
	}
}

/*=================================================================================================================	
'* Retorna array de <tags> de acordo com <id> da categoria informada.
'=================================================================================================================*/
function get_category_tags($idCategoria) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
	SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link, terms2.slug tag_slug, t2.count as post_total
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,
			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id

		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' 
			AND terms1.term_id IN (".$idCategoria.") AND
			t2.taxonomy = 'post_tag' 
			AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER BY post_total DESC
	");
	$count = 0;
	foreach ($tags as $tag) {
		$tags[$count]->tag_link = get_tag_link($tag->tag_id);
		$count++;
	}
	return $tags;
}

/*=======================================================================================================	
'* Retorna padrão de url tag
'========================================================================================================*/	
function retornaUrlTag($pSlugTag, $pUrl){
	if (!empty($pSlugTag)){
		return $pUrl."tag/".$pSlugTag;
	}else{
		return $pUrl;
	}
}

/*=======================================================================================================	
'* Retorna o nome do dia da semana, por extenso, informando o id do dia da semana.
'========================================================================================================*/	
function retornaDiaSemanaPorExtenso($idDiaSemana){
	$aryDiaSemanaPorExtenso = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", 
"Sábado");			
	return $aryDiaSemanaPorExtenso[$idDiaSemana];
}

/*=================================================================================================================	
'* Exibe estilo css das categorias filhas de projeto
'=================================================================================================================*/					
function cssProjetos($pObjCategoriasFilhasProjeto){
	if ($pObjCategoriasFilhasProjeto) {             
		$css = null;
		foreach($pObjCategoriasFilhasProjeto as $term) {	    			
			$cor = get_field('cor_projeto_area', 'category_'.$term->term_id);
			if (!empty($cor)){					
				$css .= '.'.$term->slug.'_color { ';
					$css .= " color: ".$cor." !important;";
				$css .= " } ";

				$css .= '.'.$term->slug.'_background-color { ';
					$css .= " background-color: ".$cor." !important;";
				$css .= " } ";

				$css .= '.'.$term->slug.'_border-color { ';
					$css .= " border-color: ".$cor." !important;";
				$css .= " } ";


				$css .= '.'.$term->slug.'_link:hover, ';
				$css .= '.'.$term->slug.'_link:focus{ ';
					$css .= " background-color: transparent !important; ";
					$css .= " border-color: transparent !important; ";						
					$css .= " font-weight: bold !important; ";						
					$css .= " color: ".$cor." !important;";
				$css .= ' } ';

			} //> if (!empty($cor)){
		} //>  foreach($pObjCategoriasFilhasProjeto as $term) {	 

		//> Monta estilo css das categorias filhas de projeto sem cor definida
		$css .= '.categoria_padrao_color { ';
			$css .= " color: #606062 !important;";
		$css .= " } ";

		$css .= '.categoria_padrao_background-color { ';
			$css .= " background-color: #606062 !important;";
		$css .= " } ";

		$css .= '.categoria_padrao_border-color { ';
			$css .= " border-color: #606062 !important;";
		$css .= " } ";

		$css .= '.categoria_padrao_link:hover, ';
		$css .= '.categoria_padrao_link:focus, ';
		$css .= '.categoria_padrao_link:active, ';
		$css .= '.categoria_padrao_link:visited{ ';
			$css .= " background-color: transparent !important; ";
			$css .= " border-color: transparent !important; ";						
			$css .= " font-weight: bold !important; ";						
			$css .= " color: #606062 !important;";
		$css .= ' } ';

		echo $css;
	} //>  if ($pObjCategoriasFilhasProjeto) {

}
/*=================================================================================================================	
'* Exibe a relação de categorias filhas de projeto <Menu de projetos top site>
'=================================================================================================================*/					
function exibeItensProjetosMenuTopoSite($pObjCategoriasFilhasProjeto, $pAryIdsCategoriasAcessada){
	if ($pObjCategoriasFilhasProjeto){
		foreach($pObjCategoriasFilhasProjeto as $term) {																
			$corProjeto = get_field('cor_projeto_area', 'category_'.$term->term_id);
			//> Destaca o link do projeto acessado
			$destacarAcessadoLink = null;
			$classProjeto = null;

			if (in_array($term->term_id ,$pAryIdsCategoriasAcessada)){
				$classProjeto .=  'destacar-link-projeto ';
			}

			if (!empty($corProjeto)){								
				$classProjeto .=  $term->slug.'_color ';
				$classProjeto .=  $term->slug.'_link ';								
			}else{
				$classProjeto .=  'categoria_padrao_color ';
				$classProjeto .=  'categoria_padrao_link ';								
			}

			if (!empty($classProjeto)){
				$classProjeto =  'class="'.$classProjeto.'"';
			}

			echo '<li> <a href="'.get_term_link($term).'" '.$classProjeto.' >'.$term->name.'</a></li>';
		}
	}
}

/*=================================================================================================================	
'* Exibe padrão de menu de tags rodapé
'=================================================================================================================*/											
function exibeTagsMenuRodape($pObjCategoria){
	if ($pObjCategoria){	
		$urlBaseCategoriaTag = get_site_url()."/".$pObjCategoria->slug."/";	
		echo '<li class="titulo-item-rodape"><a href="'.$urlBaseCategoriaTag.'">'.$pObjCategoria->name.'</a></li>';	
		$aryTagsAFundacao = get_category_tags($pObjCategoria->term_id);
		//echo '<div class="fonte-opcoes-rodape" style="line-height:1.3;">';
		if ($aryTagsAFundacao){																					
			foreach ($aryTagsAFundacao as $tag){
				echo '<li> <a href="'.retornaUrlTag($tag->tag_slug, $urlBaseCategoriaTag).'">'.$tag->tag_name.'</a></li>';	
			}							
		}
		//echo '</div>';
	}
}


	/*=================================================================================================================	
	'* Define padrão de redirecionamento de categoria/tag post aplicado no site.
	'=================================================================================================================*/					
	function padraoRedirecionamentoSite($pIdTagAcessada, $pIdCategoriaPrincipalAcessada){
		//> Url de categorias
		$urlCategorias = get_site_url().retornaUrlComplementarCategorias();
	
		//> Retorna objeto conforme o id da tag informada
		if (!empty($pIdTagAcessada)){
			echo $pIdTagAcessada;
		
			//> Objeto <<tag>> acessada 		
			//>>>>>>>>>>>>>>>>>>>>>>>> get_the_tags
			$objTerms = get_terms('post_tag', 'include='.$pIdTagAcessada);			
			
			/*=================================================================================================================	
			'* Não aplica redirecionamento para as <<áreas de conteúdo: SLUG_AREAS_CONTEUDO>>, informada no <<sp-config.php>>
			'=================================================================================================================*/					
			if (in_array($objTerms[0]->slug, unserialize(SLUG_AREAS_CONTEUDO))){
				return null;				
			}

			
			/*=================================================================================================================	
			'* Aplica redirecionamento na existência de apenas 1 post vinculado ao item de menu/tag
			'=================================================================================================================*/					
			$args = array(
				'post_type' => 'post', //> Tipo de post
				'post_status'=> 'publish', //> Exibir post com a situação publicado
				'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
				'cat' => $pIdCategoriaPrincipalAcessada,
				'tag_id' => $objTerms[0]->term_id,
				'order' => 'asc'
			);					
			$query = new WP_Query($args);	
			
			if ( $query->have_posts()){
				if ($query->post_count == 1){ //> retorna total de posts
					$urlDestino = $urlCategorias.$query->post->post_name;
					//> Redireciona para o único post vinculado a tag.
					wp_redirect($urlDestino, 302);		
				}
			}			
			return null;	
		}
		
		
		/*=================================================================================================================	
		'* Retorna a relação de tags, com posts relacionadas a categoria principal informada.
		'=================================================================================================================*/							
		$aryTags = get_category_tags($pIdCategoriaPrincipalAcessada);
		
		
		var_dump($aryTags);
		
		if (!empty($aryTags)){
			/*=================================================================================================================	
			'* Com base no id da primeira tag retornada e na categoria principal, retornar os posts relacionados.
			'=================================================================================================================*/					
			$args = array(
				'post_type' => 'post', //> Tipo de post
				'post_status'=> 'publish', //> Exibir post com a situação publicado
				'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
				'cat' => $pIdCategoriaPrincipalAcessada,
				'tag_id' => $aryTags[0]->tag_id,
				'order' => 'asc'
			);					
			$query = new WP_Query($args);	
									
			$urlDestino = null;
			if ( $query->have_posts()){
				
				/*=================================================================================================================	
				'* Se o total de posts retornados for igual a 1, então redirecionar para o post, caso contrário listar todos os 
				'* post vinculados.
				'=================================================================================================================*/					
				if ($query->post_count == 1){ //> retorna total de posts
					$urlDestino = $urlCategorias.$query->post->post_name;
				}else{					
					$urlDestino = retornaUrlTag($aryTags[0]->tag_slug, $urlCategorias);
				}
				//> Redireciona						
				if (!empty($urlDestino)){
					wp_redirect($urlDestino, 302);
				}
	
			}
		}
		
		
	}
	




/**
 * Enqueue scripts and styles.
 */
function dazzling_scripts_complementar() {

  wp_enqueue_script( 'dazzling-main', get_template_directory_uri()."-child". '/includes/js/functions_complementares.js', array('jquery'));

}
add_action( 'wp_enqueue_scripts', 'dazzling_scripts_complementar' );











