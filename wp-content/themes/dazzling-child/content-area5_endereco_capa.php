<?php
    include(get_template_directory() . "-child/includes/complementar.php");
    $args = array(
        'post_type' => 'area5_post_type', //> Tipo de post <area1_post_type>		
        'post_status'=> 'publish', //> Exibir post com a situação publicado
        'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
        'order' => 'asc'
    );			
    $query = new WP_Query($args);
    if ( $query->have_posts()){
        $query->the_post();
        echo get_field("contato_area_5");
    }        
    //> Restaura os dados originais do post
    wp_reset_postdata();
?>		