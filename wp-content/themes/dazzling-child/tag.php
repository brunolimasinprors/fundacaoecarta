


<?php

		/*=================================================================================================================	
		'* Identifica a categoria acessada
		'=================================================================================================================*/					
		$aryIdsCategoriasAcessada = retornaIdsCategoriasUrlAcessada();
		$idUltimaCategoriaAcessada = $aryIdsCategoriasAcessada[count($aryIdsCategoriasAcessada)-1];
		//echo $idUltimaCategoriaAcessada;
		//print_r();
		
		$aryTags = get_category_tags($idUltimaCategoriaAcessada);
		
		
		


 /**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
 
//> INCLUI CABEÇALHO 
get_header(); 


					
					

?>	

<section id="primary" class="content-area col-sm-12 col-md-12">
	<main id="main" class="site-main" role="main">

		<div class="page-content">
			<div class="row">
				<div class="content-area col-sm-12 col-md-3">
				
					<?php
					print_r($aryTags);
					?>
					<ul class="nav nav-tabs nav-stacked menu-principal-projetos">
					  <?php
						echo retornaUrlAtual();
					  
						foreach ($aryTags as $tag){
							echo '<li><a href="#">'.$tag->tag_name.'</a></li>';							
							
						}
						/*
						http://localhost/fundacaoecarta/conversa-de-professor/tag/apresentacao/
						*/
						
					  ?>
					  <!--
					  <li><a href="#">apresentação</a></li>
					  <li><a href="#">agenda</a></li>
					  <li><a href="#">notícias</a></li>
					  <li><a href="#">vídeos</a></li>					  
					  -->
					</ul>
				</div>				
				<div class="content-area col-sm-12 col-md-9">
					teste aaa
				</div> 					
			</div>
			<div class="row">
				<div class="content-area col-sm-12 col-md-12">	

				
					XXXXXX asas sasa sasa <br/>
					XXXXXX
				</div> 					
			</div>			
			
			
		</div>


	</main><!-- #main -->

		
		

<?php get_footer(); ?>
