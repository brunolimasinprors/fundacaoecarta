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
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 1,	
    'container'         => false,
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
    'menu_class'        => 'nav navbar-nav itens-menu',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker(),
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
	));
  



} /* end header menu */

/*-------------------------------------------------------------------------------------------*/
/* ÁREA 0 | EDITAR CRITÉRIOS BUSCADORES
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area0_post_type {
	
	function area0_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Critérios Buscadores - Área 0',
		    'singular_name' => 'Área 0',
		    'add_new' => 'Novo Critério',
		    'all_items' => 'Todos os Critério',
		    'add_new_item' => 'Adiciona novo Critério',
		    'edit_item' => 'Editar Critério',
		    'new_item' => 'New Post',
		    'view_item' => 'Ver Critério',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Critério não cadastrado',
		    'not_found_in_trash' => 'Nenhum critério na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar os critérios para indexação nos buscadores - ÁREA 0",
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
			'rewrite' => array('slug' => 'area0'),
			'query_var' => true,
			'can_export' => true
		); 
		register_post_type('area0_post_type',$args);
	}
}

$area0_post_type = new area0_post_type();


/*-------------------------------------------------------------------------------------------*/
/* ÁREA 1 | EDITAR GALERIA DESTAQUES
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area1_post_type {
	
	function area1_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Galeria Destaques - Área 1',
		    'singular_name' => 'Área 1',
		    'add_new' => 'Novo Destaque',
		    'all_items' => 'Todos os Destaques',
		    'add_new_item' => 'Adiciona novo destaque',
		    'edit_item' => 'Editar Destaque',
		    'new_item' => 'New Post',
		    'view_item' => 'Ver Destaque',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Destaque não cadastrado',
		    'not_found_in_trash' => 'Nenhum destaque na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar os destaques da galeria que serão exibidas na capa do site - ÁREA 1",
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
		register_post_type('area1_post_type',$args);
	}
}

$area1_post_type = new area1_post_type();

/*-------------------------------------------------------------------------------------------*/
/* ÁREA 2 | EDITAR AGENDA
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area2_post_type {
	
	function area2_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Agenda - Área 2 ',
		    'singular_name' => 'Área 2',
		    'add_new' => 'Novo Evento',
		    'all_items' => 'Todos Eventos',
		    'edit_item' => 'Editar Evento',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Evento não cadastrado',
		    'not_found_in_trash' => 'Nenhum evento na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar os eventos que serão exibidas na capa do site - ÁREA 2",
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
		register_post_type('area2_post_type',$args);
	}
}

$area2_post_type = new area2_post_type();


/*-------------------------------------------------------------------------------------------*/
/* ÁREA 3 | EDITAR DESTAQUES
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area3_post_type {
	
	function area3_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Destaques - Área 3 ',
		    'singular_name' => 'Área 3',
		    'add_new' => 'Novo Destaque',
    		    'all_items' => 'Todos os Destaques',
		    'add_new_item' => 'Adiciona novo destaque',
		    'edit_item' => 'Editar Destaque',
		    'new_item' => 'New Post',
		    'view_item' => 'Ver Destaque',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Destaque não cadastrado',
		    'not_found_in_trash' => 'Nenhum destaque na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar os destaques que serão exibidas na capa do site - ÁREA 3",
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
		register_post_type('area3_post_type',$args);
	}
}

$area3_post_type = new area3_post_type();


/*-------------------------------------------------------------------------------------------*/
/* ÁREA 5 | EDITAR ENDEREÇO
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area5_post_type {
	
	function area5_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Endereço - Área 5',
		    'singular_name' => 'Área 5',
		    'add_new' => 'Novo Endereço',
		    'all_items' => 'Todos Endereços',
		    'edit_item' => 'Editar Endereço',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Nenhum endereço cadastrado',
		    'not_found_in_trash' => 'Nenhuma endereço na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar o endereço que será exibido na capa do site - ÁREA 5",
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
		register_post_type('area5_post_type',$args);
	}
}

$area5_post_type = new area5_post_type();


/*-------------------------------------------------------------------------------------------*/
/* ÁREA 6 | EDITAR APOIOS
/* Cria post type específico para esta área */
/*-------------------------------------------------------------------------------------------*/
class area6_post_type {
	
	function area6_post_type() {
		add_action('init',array($this,'create_post_type'));
	}
	
	function create_post_type() {
		$labels = array(
		    'name' => 'Apoios - Área 6 ',
		    'singular_name' => 'Área 6',
		    'add_new' => 'Novo apoio',
		    'all_items' => 'Todos Apoios',
		    'edit_item' => 'Editar Apoio',
		    'search_items' => 'Procurar',
		    'not_found' =>  'Nenhum apoio cadastrada',
		    'not_found_in_trash' => 'Nenhum apoio na lixeira',
		    'parent_item_colon' => 'Parent Post:',
		    'menu_name' => 'Posts'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastrar os apoios que serão exibidos na capa do site - ÁREA 6",
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
		register_post_type('area6_post_type',$args);
	}
}

$area6_post_type = new area6_post_type();


 
 
 
 
?>
