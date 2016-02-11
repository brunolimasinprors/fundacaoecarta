<?php

	
	$args = array(
		'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
		'post_status'=> 'publish', //> Exibir post com a situação publicado	
		'cat' => $idCategoriaPrincipalAcessada, //> Id categoria principal acessada
		//> Exibir posts com <<data fim>> menor que a <<data hora atual>>
		'meta_query' => array(			
			array(
				'key'		=> 'data_fim_area_2', //> Data fim evento
				'compare'	=> '<',
				'value'		=> date('Ymd') //> Data Atual
			)
	    ),		
		//> Ordenado de forma decrescente pela <<data de início>>
		'meta_key' => 'data_inicio_area_2', //> Data fim evento
		'orderby' => 'meta_value_num',
		'order' => 'DESC'	
	);			
	

	$query = new WP_Query($args);
	
	$Imagens = null;
	$Conteudo = null;
	$objImagem = null;
	
	if ( $query->have_posts()){
						
		while ( $query->have_posts() ) {
			$query->the_post();
			
			$dataInicio =  date("d/m/Y",strtotime(get_field("data_inicio_area_2")));
			$dataFim =  date('d/m/Y', strtotime(get_field("data_fim_area_2")));
				
			$anoFim = date('Y', strtotime(get_field("data_fim_area_2"))); 	
			
			
			echo $anoFim."<br/>";
		
		
		} //> while ( $query->have_posts() ) {	

		


		
	} //> if ( $query->have_posts()){		
			
		
	//echo $Conteudo;


?>
