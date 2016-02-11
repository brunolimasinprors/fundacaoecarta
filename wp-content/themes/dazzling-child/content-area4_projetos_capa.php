<?php
	include(get_template_directory() . "-child/includes/complementar.php");

	$Conteudo = null;
	$Conteudo .= '<div class="chamadas-principais area4">';
	   $Conteudo .= '<div class="row">';
		  $Conteudo .= '<div class="content-area col-sm-12 col-md-12">';
			 $Conteudo .= '<hr class="linha-h4"/>';
			 $Conteudo .= '<h4 class="titulo-linha-h4">projetos</h4>';
		  $Conteudo .= '</div>';
	   $Conteudo .= '</div>';
	   
	   $Conteudo .= '<div class="slide-carousel-horizontal-capa carousel slide" data-ride="carousel" data-type="multi" id="area-slide-carousel-projetos-capa" data-interval="0">';
		  $Conteudo .= '<div class="carousel-inner">';
		

		if ($objCategoriasFilhasProjeto) {
		  $count = 0;
		  /*=================================================================================================================	
		  '* Retorna a relação de categorias filhas de projeto, com imagem vinculada
		  '=================================================================================================================*/					
		  foreach($objCategoriasFilhasProjeto as $term) {
			$objImagem = get_field('logo_projeto_area', 'category_'.$term->term_id);
			
			/*=======================================================================================================	
			'* Verifica a existência da imagem da categoria filha de projeto.
			'========================================================================================================*/							
			if (!empty($objImagem)){					
				$corProjeto = get_field('cor_projeto_area', 'category_'.$term->term_id); //> Recebe a cor do projeto corrente
				$cssBordaCategoria = null;
				if (!empty($corProjeto)){
					$cssBordaCategoria = $term->slug."_border-color";
				}else{
					$cssBordaCategoria = "categoria_padrao_border-color";
				}

				/*=======================================================================================================	
				'* Seta a classe <active> o primeiro projeto a ser exibido.
				'========================================================================================================*/							
				$ativo = "";
				if ($count == 0){
					$ativo = "active";
				} //> if ($count == 0){
				
				$Conteudo .=  '<div class="item '.$ativo.'">';
				  $Conteudo .=  '<div class="content-area col-sm-12 col-md-3">';
					 $Conteudo .=  '<div class="thumbnail">';
						$Conteudo .=  '<a href="'.get_term_link($term).'">';
							$Conteudo .=  '<hr class="linha-h4 '.$cssBordaCategoria.'">';
							$Conteudo .=  '<img src="'.$objImagem.'" alt="'.$term->name.'" title="'.$term->name.'" class="img-responsive img-area4_projetos_capa">';
							$Conteudo .=  '<hr class="linha-h4 '.$cssBordaCategoria.'">';
						$Conteudo .=  '</a>';									
					 $Conteudo .=  '</div>';
				  $Conteudo .=  '</div>';
				$Conteudo .= '</div>';
				
				$count ++;
			
			} //> if (!empty($objImagem)){			
		  } //> foreach($objCategoriasFilhasProjeto as $term) {
		} //> if ($objCategoriasFilhasProjeto) {
				
	  
			
		$Conteudo .= '</div>';
		$Conteudo .= '<a class="left carousel-control" href="#area-slide-carousel-projetos-capa" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>';
		$Conteudo .= '<a class="right carousel-control" href="#area-slide-carousel-projetos-capa" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>';
	$Conteudo .= '</div>';
	
	if ($count > 0){
		/*=======================================================================================================	
		'* Exibe a conteúdo	
		'========================================================================================================*/							
		echo $Conteudo;				
	}
		
	?>		