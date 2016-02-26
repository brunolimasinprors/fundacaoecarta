<?php
	include(get_template_directory() . "-child/includes/complementar.php");
        
	$args = array(
		'post_type' => 'area6_post_type', //> Tipo de post <area1_post_type>		
		'post_status'=> 'publish', //> Exibir post com a situação publicado
		'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
		'order' => 'asc'
	);			
	$query = new WP_Query($args);
	
	$Imagens = null;
	$Conteudo = null;
	$objImagem = null;
        $link = null;

	if ( $query->have_posts()){
            $Conteudo = '<ul class="list-unstyled">';
                $Conteudo .= '<li class="titulo-item-rodape">apoio</li>';
            
            while ( $query->have_posts() ) {	
                $query->the_post();
                
                $objImagem = get_field("imagem_area_6");
                $creditoImagem = retornaPadraoTituloImagem($objImagem);
                

                $link = get_field("site_area_6");
                if (empty($link)) $link = "#";                
                $Conteudo .= '<li class="apoio-espacamento"><a href="'.$link.'"><img class="img-responsive" src="'.$objImagem["url"].'" title="'.$creditoImagem.'" alt="'.$creditoImagem.'" width="87" /></a></li>';
            }    
            $Conteudo .= '</ul>';        
        }    
        
        echo $Conteudo;
        
?>		