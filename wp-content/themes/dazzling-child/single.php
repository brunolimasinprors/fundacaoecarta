<?php
 /**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */

get_header(); ?>

<section id="primary" class="content-area col-sm-12 col-md-12">
    <main id="main" class="site-main" role="main">
        <div class="page-content">
            <div class="row">
                <div class="content-area col-sm-3 col-md-3 col-lg-4">					
                    <?php
                    /*=================================================================================================================	
                    '* Exibe menu lateral
                    '=================================================================================================================*/					
                    get_template_part('content-menu_lateral', get_post_format());		
                    ?>                    
                </div>				
                <div class="content-area col-sm-8 col-md-8 col-lg-8">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'single' ); ?>
                       
                    <?php endwhile; // end of the loop. ?>
                </div> 					
            </div>
            <?php get_footer(); ?>