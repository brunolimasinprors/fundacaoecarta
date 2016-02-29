<?php
	include(get_template_directory() . "-child/includes/complementar.php");
	/*=================================================================================================================	
	'* Retorna a relação de posts pertencentes a <<categoria principal acessada>>
	'=================================================================================================================*/
	$idPagina = retornaPaginaAcessada(retornaUrlAtual());
	if (empty($idPagina)){
		$idPagina = 1;
	}	
	
	
	$args = array(
		'post_type' => 'post', //> Tipo de post <area2_post_type>
		'post_status' => 'publish', //> Exibir post com a situação publicado	
		'cat' => $idCategoriaPrincipalAcessada, //> Id categoria principal acessada
		'tag_id' => $idTagAcessada,
		'posts_per_page' => 2, 
	    'paged' => $idPagina,
		'orderby' => 'date',
		'order' => 'DESC'
	);
	
	
	$query = new WP_Query($args);

	$Imagens = null;
	$Conteudo = null;
	$objImagem = null;
	$count = 0;

	$idCategoriaPrincipal = retornaIdCategoriaPrincipalPost($post->ID);							
	$aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipal);                
	while ( $query->have_posts() ) {
		$query->the_post();
		/*=======================================================================================================	
		'* Exibe Conteúdo agenda
		'========================================================================================================*/							
		include(get_template_directory() . "-child/includes/conteudo-noticias.php");
		$count ++;
	}	

	//echo $Conteudo;


$big = 999999999; // need an unlikely integer

$return = paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
        'prev_next'  =>false ,
       
        'type' => 'list',
	'total' => $query->max_num_pages
) );

    echo str_replace( "<ul class='page-numbers'>", '<ul class="menu-paginas-noticias">', $return );
    
?>





