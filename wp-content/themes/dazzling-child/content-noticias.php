<?php

    include(get_template_directory() . "-child/includes/complementar.php");
    /* =================================================================================================================	
      '* Retorna a relação de posts pertencentes a <<categoria principal acessada>>
      '================================================================================================================= */
    $idPagina = retornaPaginaAcessada(retornaUrlAtual());
    if (empty($idPagina)) {
        $idPagina = 1;
    }


    $args = array(
        'post_type' => 'post', //> Tipo de post <area2_post_type>
        'post_status' => 'publish', //> Exibir post com a situação publicado	
        'cat' => $idCategoriaPrincipalAcessada, //> Id categoria principal acessada
        'tag_id' => $idTagAcessada,
        'posts_per_page' => TOTAL_POSTS_POR_PAGINA,
        'paged' => $idPagina,
        'orderby' => 'date',
        'order' => 'DESC'
    );


    $query = new WP_Query($args);

    $Imagens = null;
    $Conteudo = null;
    $objImagem = null;
    $count = 0;

    $idCategoriaPrincipal = retornaIdCategoriaPrincipalPost($post->ID);
    $aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipal);

    if (!$query->have_posts()) {    
        echo "Nenhuma notícia cadastrada."
    }

    while ($query->have_posts()) {
        $query->the_post();
        /* =======================================================================================================	
          '* Exibe Conteúdo agenda
          '======================================================================================================== */
        include(get_template_directory() . "-child/includes/conteudo-noticias.php");
        $count ++;
    }



    $totalPaginas = $query->max_num_pages; // need an unlikely integer
    //echo str_replace( $big, '%#%', esc_url(get_pagenum_link($big)));
    $return = paginate_links(
            array(
                'base' => str_replace($totalPaginas, '%#%', esc_url(get_pagenum_link($totalPaginas))), //> Define formato da url
                'format' => '?paged=%#%',
                'current' => max(1, $idPagina),
                'prev_next' => false,
                'type' => 'list',
                'total' => $query->max_num_pages
            )
    );


    echo str_replace("<ul class='page-numbers'>", '<ul class="page-numbers menu-paginas-noticias">', $return);

?>





