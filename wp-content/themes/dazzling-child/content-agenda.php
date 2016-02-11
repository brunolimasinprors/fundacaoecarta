<?php

	include(get_template_directory() . "-child/includes/complementar.php");
	/*=================================================================================================================	
	'* Retorna a relação de posts pertencentes a <<categoria principal acessada>>
	'=================================================================================================================*/						
	$args = array(
		'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
		'post_status'=> 'publish', //> Exibir post com a situação publicado				
		'cat' => $idCategoriaPrincipalAcessada, //> id categoria		
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

	$count = 0;	
	while ( $query->have_posts() ) {
		
		$query->the_post();
		
		$objImagem = get_field('imagem_area_2');
		$creditoImagem = retornaPadraoTituloImagem($objImagem);
		

		$dataInicio =  date("d/m/Y",strtotime(get_field("data_inicio_area_2")));
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
	
		/*=======================================================================================================	
		'* Exibe Conteúdo agenda
		'========================================================================================================*/							
		include(get_template_directory() . "-child/includes/conteudo-agenda.php");

		$count ++;
	}	
	
	echo $Conteudo;



?>
