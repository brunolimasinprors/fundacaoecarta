<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package dazzling
 * @subpackage dazzling-child
 */

/**
 * header menu (should you choose to use one)
 */
function dazzling_header_menu_customizado() {

    // display the WordPress Custom Menu if available
    wp_nav_menu(array(
        'menu' => 'primary',
        'theme_location' => 'primary',
        'depth' => 2,
        'container' => false,
        'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
        'menu_class' => 'nav navbar-nav itens-menu',
        'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
        'walker' => new wp_bootstrap_navwalker(),
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
    ));
}

/* end header menu */


/* ------------------------------------------------------------------------------------------- */
/* ÁREA 1
  /* Cria post type específico para esta área */
/* ------------------------------------------------------------------------------------------- */

class area1_post_type {

    function area1_post_type() {
        add_action('init', array($this, 'create_post_type'));
    }

    function create_post_type() {
        $labels = array(
            'name' => 'Manchete - Área 1',
            'singular_name' => 'Área 1',
            'add_new' => 'Nova Manchete',
            'all_items' => 'Todas as Manchetes',
            'add_new_item' => 'Adiciona nova manchete',
            'edit_item' => 'Editar Manchete',
            'new_item' => 'New Post',
            'view_item' => 'Ver Manchete',
            'search_items' => 'Procurar',
            'not_found' => 'No Posts found',
            'not_found_in_trash' => 'Nenhuma manchete na lixeira',
            'parent_item_colon' => 'Parent Post:',
            'menu_name' => 'Posts'
        );
        $args = array(
            'labels' => $labels,
            'description' => "Possibilita cadastrar as manchetes que serão exibidas na capa do site - ÁREA 1",
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'menu_position' => 5,
            'menu_icon' => 'null',
            'capability_type' => 'post',
            'hierarchical' => true,
            'supports' => array(),
            'taxonomies' => array('category'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'area1'),
            'query_var' => true,
            'can_export' => true
        );
        register_post_type('area1_post_type', $args);
    }

}

$area1_post_type = new area1_post_type();

/* ------------------------------------------------------------------------------------------- */
/* ÁREA 2 | Agenda
  /* Cria post type específico para esta área */
/* ------------------------------------------------------------------------------------------- */

class area2_post_type {

    function area2_post_type() {
        add_action('init', array($this, 'create_post_type'));
    }

    function create_post_type() {
        $labels = array(
            'name' => 'Eventos - Área 2 ',
            'singular_name' => 'Área 2',
            'add_new' => 'Novo evento - Área 2',
            'all_items' => 'Todos os Eventos',
            'edit_item' => 'Editar Eventos',
            'search_items' => 'Procurar',
            'not_found' => 'Nenhum evento cadastrado',
            'not_found_in_trash' => 'Nenhum evento na lixeira',
            'parent_item_colon' => 'Parent Post:',
            'menu_name' => 'Posts'
        );
        $args = array(
            'labels' => $labels,
            'description' => "Possibilita cadastrar os eventos que serão exibidas na agenda do site - ÁREA 2",
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'menu_position' => 5,
            'menu_icon' => 'null',
            'capability_type' => 'post',
            'hierarchical' => true,
            'supports' => array(),
            'taxonomies' => array('category'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'area2'),
            'query_var' => true,
            'can_export' => true
        );
        register_post_type('area2_post_type', $args);
    }

}

$area2_post_type = new area2_post_type();


/* ------------------------------------------------------------------------------------------- */
/* ÁREA 3
  /* Cria post type específico para esta área */
/* ------------------------------------------------------------------------------------------- */

class area3_post_type {

    function area3_post_type() {
        add_action('init', array($this, 'create_post_type'));
    }

    function create_post_type() {
        $labels = array(
            'name' => 'Chamadas - Área 3 ',
            'singular_name' => 'Área 3',
            'add_new' => 'Nova manchete - Área 3',
            'all_items' => 'Todas as Manchetes',
            'edit_item' => 'Editar Manchete',
            'search_items' => 'Procurar',
            'not_found' => 'Nenhuma manchete cadastrada',
            'not_found_in_trash' => 'Nenhuma manchete na lixeira',
            'parent_item_colon' => 'Parent Post:',
            'menu_name' => 'Posts'
        );
        $args = array(
            'labels' => $labels,
            'description' => "Possibilita cadastrar as manchetes que serão exibidas na capa do site - ÁREA 3",
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'menu_position' => 5,
            'menu_icon' => 'null',
            'capability_type' => 'post',
            'hierarchical' => true,
            'supports' => array(),
            'taxonomies' => array('category'),
            'has_archive' => true,
            'rewrite' => array('slug' => 'area3'),
            'query_var' => true,
            'can_export' => true
        );
        register_post_type('area3_post_type', $args);
    }

}

$area3_post_type = new area3_post_type();


register_taxonomy('category', 'post', array(
    'hierarchical' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => 'category_name',
    'rewrite' => did_action('init') ? array(
        'hierarchical' => true,
        'slug' => get_option('category_base') ? get_option('category_base') : 'category',
        'with_front' => ( get_option('category_base') && !$wp_rewrite->using_index_permalinks() ) ? false : true) : false,
    'public' => true,
    'show_ui' => true,
    '_builtin' => true,
));

register_taxonomy('post_tag', 'post', array(
    'hierarchical' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => 'tag',
    'rewrite' => did_action('init') ? array(
        'slug' => get_option('tag_base') ? get_option('tag_base') : 'tag',
        'with_front' => ( get_option('category_base') && !$wp_rewrite->using_index_permalinks() ) ? false : true) : false,
    'public' => true,
    'show_ui' => true,
    '_builtin' => true,
));



/*
  https://wordpress.org/support/topic/show-categories-filter-on-custom-post-type-list
  add_action('restrict_manage_posts', 'my_restrict_manage_posts' );
  function my_restrict_manage_posts() {
  global $typenow;
  $taxonomy = $typenow.'_type';
  if( $typenow != "page" && $typenow != "post" ){
  $filters = array($taxonomy);
  foreach ($filters as $tax_slug) {
  $tax_obj = get_taxonomy($tax_slug);
  $tax_name = $tax_obj->labels->name;
  $terms = get_terms($tax_slug);
  echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
  echo "<option value=''>Show All $tax_name</option>";
  foreach ($terms as $term) { echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
  echo "</select>";
  }
  }
  }
 */
?>
