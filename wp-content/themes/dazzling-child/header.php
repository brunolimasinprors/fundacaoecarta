<?php
/**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
include(get_stylesheet_directory() . "/includes/complementar.php");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php wp_head(); ?>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?= (!empty($metaTitulo) ? $metaTitulo : ""); ?>
        <?= (!empty($metaUrl) ? $metaUrl : ""); ?>
        <?= (!empty($metaImagem) ? $metaImagem : ""); ?>
        <?= (!empty($metaDescription) ? $metaDescription : ""); ?>
        <?= (!empty($metaKeywords) ? $metaKeywords : ""); ?>

        <style>		
<?php cssProjetos($objCategoriasFilhasProjeto); ?>
        </style>
    </head>


    <body <?php body_class(); ?>>

        <div id="page" class="hfeed site">

            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only"><?php _e('Toggle navigation', 'dazzling'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <?php if (get_header_image() != '') : ?>

                            <div id="logo">
                                <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>"/></a>
                            </div><!-- end of #logo -->

                        <?php endif; // header image was removed  ?>

                        <?php if (!get_header_image()) : ?>
                            <div id="logo">
                                <span class="site-title"><a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></span>
                            </div><!-- end of #logo -->
                        <?php endif; // header image was removed (again)     ?>

                    </div>


                    <!-- Menu --> 
                    <div class="collapse navbar-collapse navbar-ex1-collapse">                    
                        <?php dazzling_header_menu_customizado(); ?>

                        <div class="contentbusca navbar-right">
                            <!--
                            <aside id="search" class="widget widget_search">
                            -->
                            <?php get_search_form(); ?>
                            <!--
                            </aside>
                            -->
                        </div>
                    </div>
                </div>
                <div class="menu-projeto">
                    <ul class="nav nav-pills itens-projeto">
                        <?php exibeItensProjetosMenuTopoSite($objCategoriasFilhasProjeto, $aryIdsCategoriasAcessada); ?>
                    </ul>
                </div>
            </nav><!-- .site-navigation -->


            <div class="top-section">
                <?php dazzling_featured_slider(); ?>
                <?php dazzling_call_for_action(); ?>
            </div>
            <div id="content" class="container-fluid">
                <div class="container main-content-area">
                    <?php
                    global $post;
                    ?>
                    <div class="row">
