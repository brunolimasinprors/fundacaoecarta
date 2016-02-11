<?php

	/*=================================================================================================================	
	'* Retorna o id da tag acessada.
	'=================================================================================================================*/					
	$idTagAcessada = get_query_var('tag_id');
	

	/*=================================================================================================================	
	'* Retorna a relação <ids> categorias url acessada.
	'=================================================================================================================*/					
	$aryIdsCategoriasAcessada = retornaIdsCategoriasUrlAcessada();
	
	
	$aryTags = array();
	$idCategoriaPrincipalAcessada = null;

	if ($aryIdsCategoriasAcessada){
		/*=================================================================================================================	
		'* Retorna <id> categoria principal da relação de  <ids> categorias url acessada.
		'=================================================================================================================*/					
		$idCategoriaPrincipalAcessada = retornaIdCategoriaPrincipal($aryIdsCategoriasAcessada);			
	}

	if (!empty($idCategoriaPrincipalAcessada)){
		/*=================================================================================================================	
		'* Retorna o Layout/Informações da categoria principal informada.
		'=================================================================================================================*/					
		$aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipalAcessada);
		if ($aryDadosCategoria){
			$imagemCategoria = $aryDadosCategoria["imagem"];
			$cssDestacarLink = "destacar-link-projeto";
			if (!empty($aryDadosCategoria["cor"])){
				$cssLinkCategoria = $aryDadosCategoria["slug"]."_link";	
				$cssColorCategoria = $aryDadosCategoria["slug"]."_color";	
			}else{
				$cssLinkCategoria = "categoria_padrao_link";
				$cssColorCategoria = "categoria_padrao_color";	
			}
			$tituloCategoria = $aryDadosCategoria["titulo"];
		}
		/*=================================================================================================================	
		'* Retorna a relação de <tags>, relacionada a categoria principal para a exibição do <<menu lateral>>
		'=================================================================================================================*/					
		$aryTags = get_category_tags($idCategoriaPrincipalAcessada);		
	}

	
	//> Retorna Url Atual completa
	$urlAtual = "http://".retornaUrlAtual();
	
	$urlCategorias = get_site_url().retornaUrlComplementarCategorias();
	

	/*=================================================================================================================	
	'* Se o conteúdo acessado for post, retorna o slug da tag acessada.
	'=================================================================================================================*/					
	$tagSlugAcessada = null;
	if (is_single()){
		$posttags = get_the_tags(get_the_ID());
		if ($posttags) {
		  $tagSlugAcessada = $posttags[0]->slug;
		}
	}else{
		//$idTagAcessada	
		if (!empty($idTagAcessada)){
			$posttags = get_tags("include=".$idTagAcessada);
			$tagSlugAcessada = $posttags[0]->slug;
		}
	}
	
	
	/*=================================================================================================================	
	'* Referência das principais <categorias> do site
	'=================================================================================================================*/					
	$objCategoriaAFundacao = get_term_by('slug', 'a-fundacao', 'category');
	$objCategoriaParcerias = get_term_by('slug', 'parcerias', 'category');
	$objCategoriaProjeto = get_term_by('slug', 'projetos', 'category');
	

	/*=================================================================================================================	
	'* Retorna a relação de categorias filhas de <projeto>.
	'=================================================================================================================*/					
	if ($objCategoriaProjeto){
		$args = array(
			'type'                     => 'post',								
			'orderby'                  => 'id',
			'order'                    => 'ASC',
			'hide_empty'               => 0, /* Exibe todos os projetos, mesmo sem posts vinculados */								
			'child_of'                  => $objCategoriaProjeto->term_id
		); 
		$objCategoriasFilhasProjeto = get_categories($args);
	}
	
?>