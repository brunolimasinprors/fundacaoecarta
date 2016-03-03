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
        $cssLinkCategoria = $aryDadosCategoria["link_css"];
        $cssColorCategoria = $aryDadosCategoria["color_css"];
        $tituloCategoria = $aryDadosCategoria["titulo"];
    }
    /* =================================================================================================================	
      '* Retorna a relação de <tags>, relacionada a categoria principal para a exibição do <<menu lateral>>
      '================================================================================================================= */
    $aryTags = get_category_tags($idCategoriaPrincipalAcessada);
}


//> Retorna Url Atual completa
$urlAtual = retornaUrlAtual();

$urlCategorias = get_site_url() . retornaUrlComplementarCategorias();


/* =================================================================================================================	
  '* Se o conteúdo acessado for post, retorna o slug da tag acessada.
  '================================================================================================================= */
$tagSlugAcessada = null;
$boolItemMenuHistorico = false;
$posttags = array();

$objImagem = null;
$resumo = null;
$palavras_chaves_post = null;

if (is_single()) {
    $posttags = get_the_tags(get_the_ID());
    if ($posttags) {
        $tagSlugAcessada = $posttags[0]->slug;
    }

    if ($tagSlugAcessada == "agenda") {
        $boolItemMenuHistorico = pertenceHistoricoAgenda(get_the_ID());
    }
} else {
    //$idTagAcessada	
    if (!empty($idTagAcessada)) {
        $args = array(
            'include' => $idTagAcessada, //> Id da tag
            'hide_empty' => 0            //> Exibe todos os termos, mesmo sem post vinculado
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

if (!empty($palavras_chaves_post)) {
    $palavrasChaves = formataPalavrasChave($palavras_chaves_post, ',');
}

/* =================================================================================================================	
  '* Retorna a relação de categorias filhas de <projeto>.
  '================================================================================================================= */
if ($objCategoriaProjeto) {
    $args = array(        
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
?>
