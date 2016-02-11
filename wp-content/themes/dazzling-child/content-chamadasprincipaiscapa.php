<?php

	$args = array(
		'post_type' => 'area1_post_type', //> Tipo de post <area1_post_type>
		'showposts' => 4,   //> Quantidade maxima de  posts a serem exibidos					
		'post_status'=> 'publish', //> Exibir post com a situação publicado
		'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
		'order' => 'asc'
	);			

	$query = new WP_Query($args);
	
	$Imagens = null;
	$Conteudo = null;
	$objImagem = null;

	/* MODELO DE CARROUSEL */
	$Conteudo = '<div id="chamadas-principais" class="carousel slide carousel-fade">';
       $Conteudo .=' <ol class="carousel-indicators">';
		  for ($i = 0; $i < $query->post_count; $i ++){ 
		  	if ($i == 0){
				$classChamadasPrincipais = "active";
			}else{
				$classChamadasPrincipais = "";
			}
		  	$Conteudo .= '<li data-target="#chamadas-principais" data-slide-to="'.$i.'" class="'.$classChamadasPrincipais.'"></li>';
		  }
       $Conteudo .=  '</ol>';
	   
       /*  Itens de carousel */
       $Conteudo .= '<div class="carousel-inner">';
			
			if ( $query->have_posts()){
				$i = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					$objImagem = get_field('imagem_area_1');
					
					//print_r($objImagem);
					
					$credito = get_post_meta(intval($objImagem["id"]), 'isc_image_source', false)[0];

					$Imagens = '<a href="'.get_field('link_post_area1').'"><img src="'.$objImagem["url"].'"  alt="'.retornaPadraoTituloImagem($objImagem).'"  title="'.retornaPadraoTituloImagem($objImagem).'"  width="'.$objImagem["sizes"]["medium-width"].'" height="'.$objImagem["sizes"]["medium-height"].'"  /></a>';					
					
					if ($i == 0){
						$Conteudo .= '<div class="item active">';
					}else{
						$Conteudo .= '<div class="item">';
					}
							$Conteudo .= $Imagens;

							$Conteudo .= '<div class="carousel-caption">';
								$Conteudo .= '<h3 class="slider-chamada">'.get_field('manchete_area1').'</h3>';
								$Conteudo .= '<p class="slider-linhadeapoio">'.get_field('linha_de_apoio_area1').'</p>';
								$Conteudo .= '<p class="slider-credito"><small>'.$credito.'</small></p>';
							$Conteudo .= '</div>';
							
					$Conteudo .= '</div>';
					$i ++;
				} //> while ( $query->have_posts() ) {

					
			} else {
				// INFORMAÇÕES PADRÃO CASO NÃO HAJA NENHUM CADASTRADO
				$Imagens .= '<a href="#"><img src="'.get_stylesheet_directory_uri().'/imagens/destaque_principal_capa.jpg" title="Fundação Ecarta"/></a>';
	
				$Conteudo .= '<div class="item active">';
				$Conteudo .= $Imagens;
					$Conteudo .= '<div class="carousel-caption">';
						$Conteudo .= '<h3 class="slider-chamada">Fundação Cultural e Assistencial</h3>';
						$Conteudo .= '<p class="slider-linhadeapoio">A Fundação Ecarta é um presente dos professores do ensino privado do RS a toda a sociedade gaúcha. </p>';
						$Conteudo .= '<p class="slider-credito"><small>Foto: Divulgação</small></p>';
					$Conteudo .= '</div>';
				$Conteudo .= '</div>';	
			}
			/* Restaura as configuração original do post */
			wp_reset_postdata();				

      $Conteudo .= ' </div> ';  
     $Conteudo .= '</div>';   

	echo $Conteudo;
?>

