<?php

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
                <div class="content-area col-sm-2 col-md-3">
                    <?php
                        /*=================================================================================================================	
                        '* Exibe menu lateral
                        '=================================================================================================================*/					
                        get_template_part('content-menu_lateral_agenda', get_post_format());		
                    ?>                           
                </div>				
                <div class="content-area col-sm-10 col-md-9">
                    <?php
                    /*=================================================================================================================	
                    '* Exibe a relação de eventos da <<AGENDA>>
                    '=================================================================================================================*/					
                    get_template_part('content-filtros_agenda', get_post_format());		
                    ?>                          
                </div> 					
            
            <div class="row">
                <div class="content-area col-sm-6 col-md-6">
<!--                   // Exibe o icone de carregamento-->
                    <div class="area-exibir-agenda opacity-agenda" style="display:none">
                        
                    </div>
                   <div class="area-exibir-agenda1" style="display:none">
                        
                    </div>
                   
                    <?php
                    /*=================================================================================================================	
                    '* Exibe os filtros para eventos da <<AGENDA>>
                    '=================================================================================================================*/					
                    get_template_part('content-agenda', get_post_format());		
                    ?> 

                </div> 					
            </div>			
        </div>
       
   
<?php get_footer(); ?>
