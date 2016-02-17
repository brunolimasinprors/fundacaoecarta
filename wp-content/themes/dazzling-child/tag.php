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
                <div class="content-area col-sm-12 col-md-3">
                    <?php
                        /*=================================================================================================================	
                        '* Exibe menu lateral
                        '=================================================================================================================*/					
                        //get_template_part('content-menu_lateral_agenda', get_post_format());		
                    ?>                           
                </div>				
                <div class="content-area col-sm-12 col-md-9">
                    <?php
                    /*=================================================================================================================	
                    '* Exibe a relação de eventos da <<AGENDA>>
                    '=================================================================================================================*/					
                    get_template_part('content-agenda', get_post_format());		
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
