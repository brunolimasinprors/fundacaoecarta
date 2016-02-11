<?php

 /**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
	
	
	
	
	
	
	padraoRedirecionamentoSite(get_query_var('tag_id'), $idCategoriaPrincipalAcessada);	 

	
	
		//echo $tagSlugAcessada;
	

	//> INCLUI CABEÇALHO 
	get_header(); 


?>	

<section id="primary" class="content-area col-sm-12 col-md-12">
	<main id="main" class="site-main" role="main">

		<div class="page-content">
			<div class="row">
				<div class="content-area col-sm-12 col-md-3">
					
					<?php
					/*=================================================================================================================	
					'* Exibe menu lateral
					'=================================================================================================================*/					
					get_template_part('content-menu_lateral', get_post_format());		
					?>                    
				</div>				
				<div class="content-area col-sm-12 col-md-9">
					<?php            
                    /* 
                     *				>> AGENDA
                     */
					$idTagAcessada = get_query_var('tag_id');
					
					if (!empty($idTagAcessada)){
						$objTerms = get_terms('post_tag', 'include='.$idTagAcessada);	
						/*=================================================================================================================	
						'* Exibe conteúdo agenda
						'=================================================================================================================*/					
						if ($objTerms[0]->slug == "agenda"){
							get_template_part('content-agenda', get_post_format());	

						}elseif ($objTerms[0]->slug == "historico"){
							get_template_part('content-historico', get_post_format());	
						}else{
							get_template_part('content-padrao', get_post_format());		
						}
					}					
					//echo retornaUrlComplementarCategorias();
					//echo get_site_url();
					?>
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
