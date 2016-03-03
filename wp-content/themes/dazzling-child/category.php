<?php
/**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
padraoRedirecionamentoSite(get_query_var('tag_id'), $idCategoriaPrincipalAcessada);

//> INCLUI CABEÇALHO 
get_header();
?>	

<section id="primary" class="content-area col-sm-12 col-md-12">
    <main id="main" class="site-main" role="main">
        <div class="page-content">
            <div class="row">
                <div class="content-area col-sm-12 col-md-3">
                    <?php
                    /* =================================================================================================================	
                    '* Exibe menu lateral
                    '=================================================================================================================== */
                    get_template_part('content-menu_lateral', get_post_format());
                    ?>                    
                </div>				
                <div class="content-area col-sm-12 col-md-9">
                    <?php
                    $tag = get_term_by('id', get_query_var('tag_id'), 'post_tag');                    
                    if ($tag) {
                        /* =================================================================================================================	
                          '* Exibe conteúdo o layout da area/tag acessada
                          '================================================================================================================= */
                        if ($tag->slug == "agenda") {
                            get_template_part('content-category_agenda', get_post_format());
                        } elseif ($tag->slug == "historico") {
                            get_template_part('content-historico', get_post_format());
                        } elseif ($tag->slug == "noticias") {
                            get_template_part('content-noticias', get_post_format());
                        
                        }else {
                            get_template_part('content-padrao', get_post_format());
                        }
                    }
                     
                    ?>
                </div> 					
            </div>
            
            <div class="row">
                <div class="content-area col-sm-12 col-md-12">	
                  
                </div> 					
            </div>			
        
        	
        <?php get_footer(); ?>
