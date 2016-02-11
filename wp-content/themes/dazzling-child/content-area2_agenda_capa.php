<?php

	
	$args = array(
		'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
		'post_status'=> 'publish', //> Exibir post com a situação publicado		
		'meta_query' => array(
			array(
				'key'		=> 'data_fim_area_2',
				'compare'	=> '>=',
				'value'		=> date('Ymd') //> Data Atual
			)
	    ),		
		'meta_key' => 'data_inicio_area_2', // name of custom field
		'orderby' => 'meta_value_num',
		'order' => 'ASC'	
	);			
	
	
	

	$query = new WP_Query($args);
	
	$Imagens = null;
	$Conteudo = null;
	$objImagem = null;
	
	//if ( $query->have_posts()){

	


	$Conteudo .= '<div class="chamadas-principais area2">';   
			$Conteudo .= '<div class="row">';
				$Conteudo .= '<div class="content-area col-sm-12 col-md-5">';
					$Conteudo .= '<hr class="linha-h4"/>';
					$Conteudo .= '<h4 class="titulo-linha-h4">agenda</h4>';
					
					
					$Conteudo .= '<div class="setas-agenda"><a href="#area-slide-carousel-agenda-capa" data-slide="next"><i class="glyphicon glyphicon-menu-up"></i></a></div>';
					
					$Conteudo .= '<div class="area-slide-carousel-agenda-capa carousel slide" data-ride="carousel" data-type="multi" id="area-slide-carousel-agenda-capa" data-interval="0">';
						$Conteudo .= '<div class="carousel-inner">';
						$count = 0;
						
						while ( $query->have_posts() ) {
							$query->the_post();
							
							$idCategoriaPrincipal = retornaIdCategoriaPrincipalPost($post->ID);							
							$aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipal);
							
							$cssCorCategoria = null;
							$cssBordaCategoria = null;
							$cssCorFundoCategoria = null;							
							
							if (!empty($aryDadosCategoria["cor"])){
								$cssCorCategoria = $aryDadosCategoria["slug"]."_color";
								$cssBordaCategoria = $aryDadosCategoria["slug"]."_border-color";
								$cssCorFundoCategoria = $aryDadosCategoria["slug"]."_background-color";
							}else{
								$cssCorCategoria = "categoria_padrao_color";
								$cssBordaCategoria = "categoria_padrao_border-color";
								$cssCorFundoCategoria = "categoria_padrao_background-color";
							}
							
								
							
							$objImagem = get_field('imagem_area_2');
							$creditoImagem = retornaPadraoTituloImagem($objImagem);
							

							$dataInicio =   date("d/m/Y",strtotime(get_field("data_inicio_area_2")));
						    $dataFim =  date('d/m/Y', strtotime(get_field("data_fim_area_2")));
							
							
							if ($dataInicio != $dataFim){
								$strComplementoData = "até";	
								$dataExibicao = date("d/m",strtotime(get_field("data_fim_area_2")));
								
							}else{
								$diaSemana = date("w",strtotime(get_field("data_inicio_area_2")));
								$totalCaracteresDiaSemana = 3;
								if ($diaSemana == 6){ //> Ascento do sábado
									$totalCaracteresDiaSemana = 4; 
								}
								
								$strComplementoData = substr(retornaDiaSemanaPorExtenso($diaSemana), 0, $totalCaracteresDiaSemana);
								$dataExibicao = date("d/m",strtotime(get_field("data_inicio_area_2")));															
							}
							
							
							
							/*=======================================================================================================	
							'* Seta a classe <active> o primeiro evento da agenda a ser exibido.
							'========================================================================================================*/							
							$ativo = "";
							if ($count == 0){
								$ativo = "active";
							}
						
						
							$Conteudo .= '<div class="item '.$ativo.' ">';
							
								/*=======================================================================================================	
								'* Exibe Conteúdo agenda
								'========================================================================================================*/							
								include(get_template_directory() . "-child/includes/conteudo-agenda.php");
							
							

							
							$Conteudo .= '</div>';
							$count ++;
						}	
							
						$Conteudo .= '</div>';
					$Conteudo .= '</div>';	
					$Conteudo .= '<div class="setas-agenda"><a href="#area-slide-carousel-agenda-capa" data-slide="prev"><i class="glyphicon glyphicon-menu-down"></i></a></div>';					
					
					
				$Conteudo .= '</div>';
			$Conteudo .= '</div>';	
	$Conteudo .= '</div>';			
			
			
			
		
	echo $Conteudo;


?>
