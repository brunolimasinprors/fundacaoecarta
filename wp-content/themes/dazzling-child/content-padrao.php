<?php

include(get_template_directory() . "-child/includes/complementar.php");

/* =================================================================================================================	
  '* Retorna a relação de posts com base na categoria <principal acessada> e na tag selecionada.
  '================================================================================================================= */
$args = array(
    'post_type' => 'post', //> Tipo post
    'post_status' => 'publish', //> Exibir post com a situação publicado				
    'cat' => $idCategoriaPrincipalAcessada, //> Exibe posts relacionado ao id da categoria <principal acessada>.	
    'tag_id' => $idTagAcessada, //> Exibe posts relacionado ao id da tag informada.	
    'orderby' => 'date',
    'order' => 'DESC'
);


$query = new WP_Query($args);

$Conteudo = null;
$objImagem = null;

while ($query->have_posts()) {
    $query->the_post(); //> recupera o próximo post a ser exibido
    $Conteudo .= '<a href="' . $urlCategorias . $query->post->post_name . '">';
    $Conteudo .= '<div class="media-body">';
    //if ($objImagem){										
    //$Conteudo .= '<img class="img-responsive imagem-agenda" src="'.$objImagem["url"].'"  alt="'.$creditoImagem.'"  title="'.$creditoImagem.'" width="70"  />';
    //}		
    //.the_title().
    $Conteudo .= '<h4 class="media-heading">' . get_the_title() . '</h4>';
    $Conteudo .= '<div style="display: table-cell;">';
    $Conteudo .= '<small>conteúdo</small><br/>';
    $Conteudo .= '</div>';

    $Conteudo .= '</div>';
    $Conteudo .= '</a>';
    $Conteudo .= '<hr class="linha-h4-agenda"/>';
}

echo $Conteudo;
?>
