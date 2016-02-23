<?php

/* =================================================================================================================	
  '* Retorna o id da tag acessada.
  '================================================================================================================= */
$idTagAcessada = get_query_var('tag_id');


/* =================================================================================================================	
  '* Retorna a relação <ids> categorias url acessada.
  '================================================================================================================= */
$aryIdsCategoriasAcessada = retornaIdsCategoriasUrlAcessada();

$aryTags = array();
$idCategoriaPrincipalAcessada = null;

if ($aryIdsCategoriasAcessada) {
    /* =================================================================================================================	
      '* Retorna <id> categoria principal da relação de  <ids> categorias url acessada.
      '================================================================================================================= */
    $idCategoriaPrincipalAcessada = retornaIdCategoriaPrincipal($aryIdsCategoriasAcessada);
}

if (!empty($idCategoriaPrincipalAcessada)) {
    /* =================================================================================================================	
      '* Retorna o Layout/Informações da categoria principal informada.
      '================================================================================================================= */
    $aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipalAcessada);

    if ($aryDadosCategoria) {
        $imagemCategoria = $aryDadosCategoria["imagem"];
        $cssDestacarLink = "destacar-link-projeto";
        if (!empty($aryDadosCategoria["cor"])) {
            $cssLinkCategoria = $aryDadosCategoria["slug"] . "_link";
            $cssColorCategoria = $aryDadosCategoria["slug"] . "_color";
        } else {
            $cssLinkCategoria = "categoria_padrao_link";
            $cssColorCategoria = "categoria_padrao_color";
        }
        $tituloCategoria = $aryDadosCategoria["titulo"];
    }
    /* =================================================================================================================	
      '* Retorna a relação de <tags>, relacionada a categoria principal para a exibição do <<menu lateral>>
      '================================================================================================================= */
    $aryTags = get_category_tags($idCategoriaPrincipalAcessada);
}


//> Retorna Url Atual completa
$urlAtual = "http://" . retornaUrlAtual();

$urlCategorias = get_site_url() . retornaUrlComplementarCategorias();


/* =================================================================================================================	
  '* Se o conteúdo acessado for post, retorna o slug da tag acessada.
  '================================================================================================================= */
$tagSlugAcessada = null;
$posttags = array();

if (is_single()) {

    $posttags = get_the_tags(get_the_ID());
    if ($posttags) {
        $tagSlugAcessada = $posttags[0]->slug;
    }


    //> Título
    $titulo = PHP_EOL . "<title>" . trim(wp_title('', false)) . "</title>" . PHP_EOL;
    $metaTitulo = PHP_EOL . '<meta content="' . trim(wp_title('', false)) . '" name="title">';
    $metaTitulo .= '<meta property="og:title" content="' . trim(wp_title('', false)) . '" />';

    //> URL				
    $metaUrl = PHP_EOL . '<meta property="og:url" content="' . retornaUrlAtual() . '" />';
    /* =======================================================================================================	
      '* Quando a página for de conteúdo
      '======================================================================================================== */

    //> Imagem principal								
    $objImagem = get_field('imagem_post');
    if ($objImagem) {
        $metaImagem = PHP_EOL . '<meta property="og:image" content="' . $objImagem["sizes"]["thumbnail"] . '"/>';
    }

    //> Resumo								
    $resumo = get_field('resumo_post');

    //> Criação da metatag de descrição
    if (!empty($resumo)) {
        $metaDescription = PHP_EOL . '<meta name="description" content="' . $resumo . '" />';
        $metaDescription .= PHP_EOL . '<meta property="og:description" content="' . $resumo . '" />';
    }

    //> Palavras Chaves   
    $palavras_chaves_post = get_field('palavras_chaves_post');

    if (!empty($palavras_chaves_post)) {
        $palavrasChaves = formataPalavrasChave($palavras_chaves_post, ',');
    }

    //> Criação da metatag de palavras chaves
    if (!empty($palavrasChaves)) {
        $metaKeywords = '<meta name="keywords" content="' . $palavrasChaves . '" />' . PHP_EOL;
    }
} else {
    //$idTagAcessada	
    if (!empty($idTagAcessada)) {
        $args = array(
            'include' => $idTagAcessada, //> Id da tag
            'hide_empty' => 0 //> Exibe todos os termos, mesmo sem post vinculado
        );
        $posttags = get_tags($args);
        $tagSlugAcessada = $posttags[0]->slug;
    }
}


/* =================================================================================================================	
  '* Referência das principais <categorias> do site
  '================================================================================================================= */
$objCategoriaAFundacao = get_term_by('slug', 'a-fundacao', 'category');
$objCategoriaParcerias = get_term_by('slug', 'parcerias', 'category');


$objCategoriaProjeto = get_term_by('slug', 'projetos', 'category');


/* =================================================================================================================	
  '* Retorna a relação de categorias filhas de <projeto>.
  '================================================================================================================= */
if ($objCategoriaProjeto) {
    $args = array(
        'type' => 'post',
        'orderby' => 'id',
        'order' => 'ASC',
        'hide_empty' => 0, /* Exibe todos os projetos, mesmo sem posts vinculados */
        'child_of' => $objCategoriaProjeto->term_id
    );
    $objCategoriasAuxFilhasProjeto = get_categories($args);
}

$objCategoriasFilhasProjeto = array();
foreach ($objCategoriasAuxFilhasProjeto as $objCategoria) {
    if (get_field('situacao_projeto_area', 'category_' . $objCategoria->term_id) == "ativo") {
        $objCategoriasFilhasProjeto[] = $objCategoria;
    }
}    