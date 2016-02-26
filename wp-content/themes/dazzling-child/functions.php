<?php

    /**
     * Dazzling functions and definitions
     *
     * @package dazzling
     * @subpackage dazzling-child
     */
    //> Area de Admin
    include_once(get_stylesheet_directory() . "/includes/theme-admin.php");
    include_once(get_stylesheet_directory() . "/includes/areas-admin.php");

    include_once(get_stylesheet_directory() . "/includes/complementar.php");
    include_once(get_stylesheet_directory() . "/includes/util.php");

    include_once(ABSPATH . "wp-content/plugins/sp-config.php");


    /*
     *  Retorna o título da imagem a ser exibida no padrão estabelecido.
     *      Padrão : título da imagem | nome do fotografo
     *      Exemplo: Negociação coletiva 2010 | Igor Sperotto
     *  @return String - Com o padrão do titulo da imagem
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */   
    if (!function_exists('retornaPadraoTituloImagem')) {
        function retornaPadraoTituloImagem($aryDados) {
            //> Nome do fotografo da imagem
            $aryDadosPluginISC = get_post_meta($aryDados["id"], 'isc_image_source', false);
            $separador = "";
            if (!empty($aryDadosPluginISC[0]) && !empty($aryDados["title"])) {
                $separador = " | ";
            }
            return $aryDados["title"] . $separador . $aryDadosPluginISC[0];
        }
    }
    
    /*
     *  Retorna o layout da categoria principal
     *  @return Array - Layout categoria principal
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */   
    function retornaLayoutCategoriaPrincipal($pIdCategoria) {
        $args = array(
            'type' => 'post',
            'orderby' => 'id',
            'order' => 'ASC',
            'hide_empty' => 0, /* Exibe todos os projetos, mesmo sem posts vinculados */
            'include' => $pIdCategoria
        );
        $categories = get_categories($args);
        if ($categories) {
            foreach ($categories as $term) {
                $aryDados["cor"] = get_field('cor_projeto_area', 'category_' . $term->term_id);
                $aryDados["imagem"] = get_field('logo_projeto_area', 'category_' . $term->term_id);
                $aryDados["titulo"] = $term->name;
                $aryDados["slug"] = $term->slug;
                //> Retorna os estilos css da <<categoria>>
                if (!empty($aryDados["cor"])) {
                    $aryDados["color_css"] = $term->slug . "_color";
                    $aryDados["border-color_css"] = $term->slug . "_border-color";
                    $aryDados["background-color_css"] = $term->slug . "_background-color";
                    $aryDados["link_css"] = $term->slug."_link";
                } else {
                    $aryDados["color_css"] = "categoria_padrao_color";
                    $aryDados["border-color_css"] = "categoria_padrao_border-color";
                    $aryDados["background-color_css"] = "categoria_padrao_background-color";
                    $aryDados["link_css"] = "categoria_padrao_link";
                }
                return $aryDados;
            }
        }
        return null;
    }

    /*
     *  Retorna o id da categoria principal do post
     *  @return String - ids categorias principal do post
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */   
    function retornaIdCategoriaPrincipal($pAryCategorias) {    
        //> Desconsidera essas categorias
        $arySlugCategoriasExcludentes[] = "projetos";
        $arySlugCategoriasExcludentes[] = "sem-categoria";
        $args = array(
            'hide_empty' => 0 /* Exibe as categorias, mesmo sem posts vinculados */
        );
        $aryCategorias = get_categories($args);
        foreach ($aryCategorias as $aryCategoria) {
            if (in_array($aryCategoria->term_id, $pAryCategorias) && (!in_array($aryCategoria->slug, $arySlugCategoriasExcludentes))) {
                return $aryCategoria->term_id;
            }
        }        
        return null;        
    }

    /*
     *  Retorna o id da categoria principal do post
     *  @return String - ids categorias principal do post
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */   
    function retornaIdCategoriaPrincipalPost($pIdPost) {
        if (empty($pIdPost)){
            return null;            
        }    
        $arySlugCategoriasPost = retornaArySlugCategoriasPost($pIdPost);
        if ($arySlugCategoriasPost){
            $ultimoPosicaoAry = count($arySlugCategoriasPost) -1;
            $objCategoria = get_category_by_slug($arySlugCategoriasPost[$ultimoPosicaoAry]); 
            return $objCategoria->term_id;
        }
        return null;
    }

    /*
     *  Retorna a relação de ids das categorias complementares existente na url acessada.
     *  @return Array - ids categorias url
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */   
    function retornaIdsCategoriasUrlAcessada() {
        //> Retorna url base do site
        $urlBaseSite = get_bloginfo('url');  //> Retorna Url Base do Site
        //> Retorna Url atual acessada
        $urlAcessada = "http://" . retornaUrlAtual();
        //> Retorna apenas o complemento da url base
        $complementoUrl = str_replace($urlBaseSite, "", $urlAcessada);
        //> array complemento da url
        $aryComplementoUrl = explode('/', $complementoUrl); //> Split o <path> na ocorrencia de </> para verificação
        $args = array(
            'hide_empty' => 0, //> Retorna categorias sem post relacionados
            'orderby' => 'name',
            'order' => 'ASC',
        );
        $postcategory = get_categories($args);
        $aryIdsCategorias = array();
        if ($postcategory) {
            /* =======================================================================================================	
            '* Verifica a existência de tags, na url acessada.
            '======================================================================================================== */
            foreach ($postcategory as $category) {
                if (in_array($category->slug, $aryComplementoUrl)) {
                    $aryIdsCategorias[] = $category->term_id;
                }
            }
        }
        return $aryIdsCategorias;
    }

    /*
     *  Retorna url complementar categorias acessada
     *  @return String - url de categorias
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function retornaUrlComplementarCategorias() {
        //> Retorna url base do site
        $urlBaseSite = get_bloginfo('url');  //> Retorna Url Base do Site
        //> Retorna Url atual acessada
        $urlAcessada = "http://" . retornaUrlAtual();
        //> Retorna apenas o complemento da url base
        $complementoUrl = str_replace($urlBaseSite, "", $urlAcessada);
        //> array complemento da url
        $aryComplementoUrl = explode('/', $complementoUrl); //> Split o <path> na ocorrencia de </> para verificação
        $args = array(
            'hide_empty' => 0, //> Retorna categorias sem post relacionados
            'orderby' => 'name',
            'order' => 'ASC',
        );
        $postcategory = get_categories($args);
        if ($postcategory) {
            /* =======================================================================================================	
              '* Verifica a existência de tags, na url acessada.
              '======================================================================================================== */
            $aryCategory = array();
            foreach ($postcategory as $category) {
                array_push($aryCategory, $category->slug);
            }
            $urlComplementarCategoria = null;
            foreach ($aryComplementoUrl as $complementoUrl) {
                if (in_array($complementoUrl, $aryCategory)) {
                    $urlComplementarCategoria .= $complementoUrl . "/";
                }
            } //> foreach($aryComplementoUrl as $complementoUrl) {				
        } //> if ($postcategory) {	
        if (!empty($urlComplementarCategoria)) {
            $urlComplementarCategoria = "/" . $urlComplementarCategoria;
        }
        return $urlComplementarCategoria;
    }

    /*
     *  Retorna array de <tags> de acordo com <id> da categoria informada.
     *  @return Array - tags
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function retornaUrlAtual() {
        $server = $_SERVER['SERVER_NAME'];
        $endereco = $_SERVER ['REQUEST_URI'];
        if (!empty($endereco)) {
            return $server . $endereco;
        } else {
            return $server;
        }
    }

    /*
     *  Retorna array de <tags> de acordo com <id> da categoria informada.
     *  @return Array - tags
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function get_category_tags($idCategoria) {
        global $wpdb;
        $tags = $wpdb->get_results
                ("
                    SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link, terms2.slug tag_slug, t2.count as post_total
                            FROM
                                    wp_posts as p1
                                    LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
                                    LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
                                    LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,
                                    wp_posts as p2
                                    LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
                                    LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
                                    LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id

                            WHERE
                                    t1.taxonomy = 'category' AND p1.post_status = 'publish' 
                                    AND terms1.term_id IN (" . $idCategoria . ") AND
                                    t2.taxonomy = 'post_tag' 
                                    AND p2.post_status = 'publish'
                                    AND p1.ID = p2.ID
                            ORDER BY post_total DESC
                ");
        $count = 0;
        foreach ($tags as $tag) {
            $tags[$count]->tag_link = get_tag_link($tag->tag_id);
            if ($tags[$count]->tag_slug == "agenda") {
                $objTag = get_term_by("slug", "historico", "post_tag");
                $aryDados = array(
                    'tag_id' => $objTag->term_id,
                    'tag_name' => $objTag->name,
                    'tag_link' => get_tag_link($objTag->term_id),
                    'tag_slug' => $objTag->slug,
                    'post_total' => $objTag->count);
                array_push($tags, (object) $aryDados);
            }
            $count++;
        }
        return $tags;
    }

    /*
     *  Retorna padrão de url tag
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function retornaUrlTag($pSlugTag, $pUrl) {
        if (!empty($pSlugTag)) {
            return $pUrl . "tag/" . $pSlugTag;
        } else {
            return $pUrl;
        }
    }

    /*
     *  Exibe estilo css das categorias filhas de projeto
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function cssProjetos($pObjCategoriasFilhasProjeto) {
        if ($pObjCategoriasFilhasProjeto) {
            $css = null;
            foreach ($pObjCategoriasFilhasProjeto as $term) {
                $cor = get_field('cor_projeto_area', 'category_' . $term->term_id);
                if (!empty($cor)) {
                    $css .= '.' . $term->slug . '_color { ';
                    $css .= " color: " . $cor . " !important;";
                    $css .= " } ";

                    $css .= '.' . $term->slug . '_background-color { ';
                    $css .= " background-color: " . $cor . " !important;";
                    $css .= " } ";

                    $css .= '.' . $term->slug . '_border-color { ';
                    $css .= " border-color: " . $cor . " !important;";
                    $css .= " } ";


                    $css .= '.' . $term->slug . '_link:hover, ';
                    $css .= '.' . $term->slug . '_link:focus{ ';
                    $css .= " background-color: transparent !important; ";
                    $css .= " border-color: transparent !important; ";
                    $css .= " font-weight: bold !important; ";
                    $css .= " color: " . $cor . " !important;";
                    $css .= ' } ';
                } //> if (!empty($cor)){
            } //>  foreach($pObjCategoriasFilhasProjeto as $term) {	 
            //> Monta estilo css das categorias filhas de projeto sem cor definida
            $css .= '.categoria_padrao_color { ';
            $css .= " color: #606062 !important;";
            $css .= " } ";

            $css .= '.categoria_padrao_background-color { ';
            $css .= " background-color: #606062 !important;";
            $css .= " } ";

            $css .= '.categoria_padrao_border-color { ';
            $css .= " border-color: #606062 !important;";
            $css .= " } ";

            $css .= '.categoria_padrao_link:hover, ';
            $css .= '.categoria_padrao_link:focus, ';
            $css .= '.categoria_padrao_link:active, ';
            $css .= '.categoria_padrao_link:visited{ ';
            $css .= " background-color: transparent !important; ";
            $css .= " border-color: transparent !important; ";
            $css .= " font-weight: bold !important; ";
            $css .= " color: #606062 !important;";
            $css .= ' } ';
            echo $css;
        } //>  if ($pObjCategoriasFilhasProjeto) {
    }

    
    /*
     *  Verifica a data final do o post da agenda é inferior a data hora atual, identificando assim como histórico.
     *  @return Boolean - true quanto o post pertencer ao histórico agenda
     * 
     * @author Lucas Emerim Marques
     * @version 25/02/2016     
    */    
    function pertenceHistoricoAgenda($pId_post) {
        global $wpdb;        
        if (empty($pId_post)){
            return false;
        }        
        $totalPosts = (int) $wpdb->get_var
                ("
                SELECT COUNT(*) total 
                FROM   wp_postmeta meta_destino 
                       INNER JOIN wp_posts post_destino 
                               ON post_destino.id = meta_destino.post_id 
                WHERE  meta_destino.meta_key LIKE 'custom_permalink' 
                       AND EXISTS (SELECT * 
                                   FROM   (SELECT link_origem.meta_value 
                                                  link, 
                                                  Max(Str_to_date(datafim_origem.meta_value, 
                                                      '%Y%m%d')) 
                                                  data_fim_evento 
                                           FROM   wp_postmeta link_origem 
                                                  INNER JOIN wp_postmeta datafim_origem 
                                                          ON datafim_origem.post_id = 
                                                             link_origem.post_id 
                                           WHERE  link_origem.meta_key = 'link_area_2' 
                                                  AND datafim_origem.meta_key = 
                                                      'data_fim_area_2' 
                                           GROUP  BY link_origem.meta_value) origem 
                                   WHERE  data_fim_evento < Date_format(Now(), '%Y%m%d') 
                                          AND Mid(( Rtrim(Ltrim(Lower(link))) ), 1, ( 
                                                  Length(( Rtrim(Ltrim(Lower(link))) )) - 1 )) 
                                              LIKE 
                                              Rtrim( 
                                              Ltrim(Lower(meta_destino.meta_value)))) 
                                              AND post_destino.ID = ".$pId_post."
                ");        
        if ($totalPosts > 0){
            return true;
        }        
        return false;        
    }    
    
    
    /*
     *  Exibe a relação de categorias filhas de projeto <Menu de projetos TOPO SITE>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function exibeItensProjetosMenuTopoSite($pObjCategoriasFilhasProjeto, $pAryIdsCategoriasAcessada) {
        if ($pObjCategoriasFilhasProjeto) {
            foreach ($pObjCategoriasFilhasProjeto as $term) {
                $corProjeto = get_field('cor_projeto_area', 'category_' . $term->term_id);
                //> Destaca o link do projeto acessado
                $destacarAcessadoLink = null;
                $classProjeto = null;

                if (in_array($term->term_id, $pAryIdsCategoriasAcessada)) {
                    $classProjeto .= 'destacar-link-projeto ';
                }

                if (!empty($corProjeto)) {
                    $classProjeto .= $term->slug . '_color ';
                    $classProjeto .= $term->slug . '_link ';
                } else {
                    $classProjeto .= 'categoria_padrao_color ';
                    $classProjeto .= 'categoria_padrao_link ';
                }
                if (!empty($classProjeto)) {
                    $classProjeto = 'class="' . $classProjeto . '"';
                }

                echo '<li> <a href="' . get_term_link($term) . '" ' . $classProjeto . ' >' . $term->name . '</a></li>';
            }
        }
    }

    /*
     *  Exibe tags padrão de menu de tags rodapé
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function exibeTagsMenuRodape($pObjCategoria) {
        if ($pObjCategoria) {
            $urlBaseCategoriaTag = get_site_url() . "/" . $pObjCategoria->slug . "/";
            echo '<li class="titulo-item-rodape"><a href="' . $urlBaseCategoriaTag . '">' . $pObjCategoria->name . '</a></li>';
            $aryTagsAFundacao = get_category_tags($pObjCategoria->term_id);
            if ($aryTagsAFundacao) {
                foreach ($aryTagsAFundacao as $tag) {
                    echo '<li> <a href="' . retornaUrlTag($tag->tag_slug, $urlBaseCategoriaTag) . '">' . $tag->tag_name . '</a></li>';
                }
            }
        }
    }

    /*
     * Define padrão de redirecionamento de categoria/tag post aplicado no site.
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function padraoRedirecionamentoSite($pIdTagAcessada, $pIdCategoriaPrincipalAcessada) {
        //> Url de categorias
        $urlCategorias = get_site_url() . retornaUrlComplementarCategorias();
        //> Retorna objeto conforme o id da tag informada
        if (!empty($pIdTagAcessada)) {
            //> Objeto <<tag>> acessada <get_the_tags>		           
            $args = array(
                'include' => $pIdTagAcessada, //> Id da tag
                'hide_empty' => 0 //> Exibe todos os termos, mesmo sem post vinculado
            );
            $objTerms = get_terms('post_tag', $args);
            /* =================================================================================================================	
              '* Não aplica redirecionamento para as <<áreas de conteúdo: SLUG_AREAS_CONTEUDO>>, informada no <<sp-config.php>>
              '================================================================================================================= */
            if (in_array($objTerms[0]->slug, unserialize(SLUG_AREAS_CONTEUDO))) {
                return null;
            }
            /* =================================================================================================================	
            '* Aplica redirecionamento na existência de apenas 1 post vinculado ao item de menu/tag
            '================================================================================================================= */
            $args = array(
                'post_type' => 'post', //> Tipo de post
                'post_status' => 'publish', //> Exibir post com a situação publicado
                'orderby' => 'menu_order', //> Aplica ordenação informada no painel de controle.
                'cat' => $pIdCategoriaPrincipalAcessada,
                'tag_id' => $objTerms[0]->term_id,
                'order' => 'asc'
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                if ($query->post_count == 1) { //> retorna total de posts
                    $urlDestino = $urlCategorias . $query->post->post_name;
                    //> Redireciona para o único post vinculado a tag.
                    wp_redirect($urlDestino, 302);
                }
            }
            return null;
        }
        /* =================================================================================================================	
        '* Retorna a relação de tags, com posts relacionadas a categoria principal informada.
        '================================================================================================================= */
        $aryTags = get_category_tags($pIdCategoriaPrincipalAcessada);
        if (!empty($aryTags)) {
            /* =================================================================================================================	
              '* Com base no id da primeira tag retornada e na categoria principal, retornar os posts relacionados.
              '================================================================================================================= */
            $args = array(
                'post_type' => 'post', //> Tipo de post
                'post_status' => 'publish', //> Exibir post com a situação publicado
                'orderby' => 'menu_order', //> Aplica ordenação informada no painel de controle.
                'cat' => $pIdCategoriaPrincipalAcessada,
                'tag_id' => $aryTags[0]->tag_id,
                'order' => 'asc'
            );
            $query = new WP_Query($args);

            $urlDestino = null;
            if ($query->have_posts()) {

                /* =================================================================================================================	
                  '* Se o total de posts retornados for igual a 1, então redirecionar para o post, caso contrário listar todos os
                  '* post vinculados.
                  '================================================================================================================= */
                if ($query->post_count == 1) { //> retorna total de posts
                    $urlDestino = $urlCategorias . $query->post->post_name;
                } else {
                    $urlDestino = retornaUrlTag($aryTags[0]->tag_slug, $urlCategorias);
                }
                //> Redireciona						
                if (!empty($urlDestino)) {
                    wp_redirect($urlDestino, 302);
                }
            }
        }
    }

    /*
     * Carrega script js <Site>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('jsComplementarSite')) {
        function jsComplementarSite() {
            wp_enqueue_script('dazzling-main', get_template_directory_uri() . "-child" . '/includes/js/functions_complementares.js', array('jquery'));
        }
        add_action('wp_enqueue_scripts', 'jsComplementarSite'); //> Gatilho
    }    


    /*
     * Carrega script js <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('jsComplementarAdmin')) {
        function jsComplementarAdmin() {
            wp_enqueue_script('custom_admin_script', get_template_directory_uri() . "-child" . '/includes/js/functions_complementares_admin.js', array('jquery'));
        }
        add_action('admin_enqueue_scripts', 'jsComplementarAdmin'); //> Gatilho
    }
    
    /*
     * Customiza o link do logo da página de login do <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('defineUrlLogoTelaLogin')) {
        function defineUrlLogoTelaLogin() {
            return get_bloginfo('url');  //> Retorna a url do site
        }
        add_filter('login_headerurl', 'defineUrlLogoTelaLogin'); //> Gatilho
    }

    /*
     * Customiza o título da página de login do <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('defineTitleLogoTelaLogin')) {
        function defineTitleLogoTelaLogin() {
            return 'Abre o site do ' . get_option('blogname'); //> Retorna o Título do site
        }
        add_filter('login_headertitle', 'defineTitleLogoTelaLogin'); //> Gatilho
    }

    /*
     * Customiza o logo da página de login do <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('defineImagemLogoTelaLogin')) {
        function defineImagemLogoTelaLogin() {
            echo '<style  type="text/css"> h1 a {  background-image:url(' . get_bloginfo('template_directory') . '-child/imagens/wordpress-logo.png)  !important; background-size: 312px 67px !important; width: 312px !important; height: 67px !important; } </style>';
        }
        add_action('login_head', 'defineImagemLogoTelaLogin'); //> Gatilho
    }


    /*
     * Customiza a informação do rodapé do <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('defineRodapeTelaAdmin')) {
        function defineRodapeTelaAdmin() {
            return '<span id="footer-thankyou">Desenvolvido por <a href="http://www.cwi.com.br" target="_blank">CWI Software</a> e equipe TI SINPRO/RS</span>';
        }
        add_filter('admin_footer_text', 'defineRodapeTelaAdmin'); //> Gatilho
    }

    /*
     * Registra página <edição da capa do site> dentro do menu Dashboard <Painel de Administração do Worpress>
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('adicionaPaginaAdmin')) {
        function adicionaPaginaAdmin() {
            add_dashboard_page('Permite editar a capa principal do Site', 'Editar Capa do Site', 'read', 'edita-capa-site', 'pagina_edicao_capa_callback');
        }
        add_action('admin_menu', 'adicionaPaginaAdmin'); //> Gatilho
    }

    /*
     * Redireciona após o login no <Painel de Administração>, para a página de edição da capa do site.
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('dashboardRedirect')) {
        function dashboardRedirect($url) {
            global $current_user;
            $url = 'wp-admin/index.php?page=edita-capa-site';
            return $url;
        }
        add_filter('login_redirect', 'dashboardRedirect'); //> Gatilho
    }

    /*
     * Aplica tag ao salvar o post.
     * Adiciona tag do post, com base no campo personalizado: <tag_item_menu_post> 
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('adicionaTagPost')) {
        function adicionaTagPost($post_id, $post, $update) {
            //> retorna o id da tag do campo personalizado
            $idTag = get_field('tag_item_menu_post', $post_id);
            $tag = array($idTag);
            //> Adiciona tag do campo personalizado ao post
            wp_set_post_terms($post_id, $tag);
        }
        add_action('save_post', 'adicionaTagPost', 10, 3); //> Gatilho
    }

    /*
     * Customiza o permalink ao salvar o post.
     * Adiciona a meta tag custom_permalink, com o link completo do post, de acordo com o padrão 
     * mantido na função: retornaUrlPost.
     * Exemplo: projetos/campanhas/apresentacao     
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('customizaPermalinkSalvarPost')) {
        function customizaPermalinkSalvarPost($post_id) {
            //> Exclui a meta tag personalizada do post <custom_permalink>
            delete_post_meta($post_id, 'custom_permalink');
            //> Adiciona a meta tag personalizada do post <custom_permalink>, com o novo padrão de url.            
            add_post_meta($post_id, 'custom_permalink', retornaUrlPost($post_id));
        }
        add_action('save_post', 'customizaPermalinkSalvarPost', 10); //> Gatinho
    }


    /*
     * Retorna permalink customizado do post.
     * Permalink mantido nas meta tags do post <custom_permalink>
     * @return Array - Slug de categoria
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    if (!function_exists('retornaPermalinkCustomizadoPost')) {
        function retornaPermalinkCustomizadoPost($url, $post) {
            $custom_permalink = get_post_meta($post->ID, 'custom_permalink', true );
            if ( $custom_permalink ) {
                return $custom_permalink;
            }  
            return $url;
        }
        //> Filtros aplicados na redefinição dos <links>
        add_filter('post_link', 'retornaPermalinkCustomizadoPost', 10, 2);
        add_filter('post_type_link', 'retornaPermalinkCustomizadoPost', 10, 2);        
    }


    /*
     * Retorna o slug do <id do post> informado
     * @return Array - Slug de categoria
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function retornaSlugPost($pId_post){
         if (empty($pId_post)){
             return null;
         }
         $post_data = get_post($pId_post, ARRAY_A);
         $slug = $post_data['post_name'];
         return $slug; 
    }

 
    /*
     * Retorna array de slug de categorias vinculadas a post.
     * @return Array - Slug de categoria
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016     
    */    
    function retornaArySlugCategoriasPost($pId_post) {
        $args = array(
            'orderby' => 'parent',
            'order' => 'ASC'
        );
        $post_categories = wp_get_object_terms($pId_post, 'category', $args);

        $aryCategorias = array();
        foreach ($post_categories as $categoria) {
            $aryCategorias[] = $categoria->slug;
        }
        return $aryCategorias;
    }

    
    /*
     * Retorna a <url> completa do post
     * @return String - Url completa
     * 
     * @author Lucas Emerim Marques
     * @version 23/02/2016
    */    
    function retornaUrlPost($pId_post){
        //> url base
        $url = get_site_url()."/";    
        //> retém  as categorias do post
        $arySlugsCategorias = retornaArySlugCategoriasPost($pId_post);
        if (!empty($arySlugsCategorias)){
            foreach ($arySlugsCategorias as $slugCategoria){ 
                $url .= $slugCategoria."/";
            }
        }
        //> adiciona o slug post
        $url .= retornaSlugPost($pId_post);
        return $url;
    }
