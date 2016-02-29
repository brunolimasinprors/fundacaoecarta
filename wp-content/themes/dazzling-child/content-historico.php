<?php
include(get_template_directory() . "-child/includes/complementar.php");
/* =================================================================================================================	
  '* Retorna a relação de posts pertencentes a <<categoria principal acessada>>
  '================================================================================================================= */

$args = array(
    'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
    'post_status' => 'publish', //> Exibir post com a situação publicado	
    'cat' => $idCategoriaPrincipalAcessada, //> Id categoria principal acessada
//> Exibir posts com <<data fim>> menor que a <<data hora atual>>
    'meta_query' => array(
        array(
            'key' => 'data_fim_area_2', //> Data fim evento
            'compare' => '<',
            'value' => date('Ymd') //> Data Atual
        )
    ),
    //> Ordenado de forma decrescente pela <<data de início>>
    'meta_key' => 'data_inicio_area_2', //> Data fim evento
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
);

$query = new WP_Query($args);

if ($query->have_posts()) {

    /*
     * Inicialização de variáveis
     */

    $count = 0;
    $ultimoAno = "";
    $arrAnosPublicados = array();

    $queryAux = $query;

    /*
     * Retorno todos os anos dos eventos publicados separadamente
     */
    while ($queryAux->have_posts()) {
        $queryAux->the_post();
        $anoFim = date('Y', strtotime(get_field("data_fim_area_2")));
        array_push($arrAnosPublicados, $anoFim);
    }

    //removo o query auxiliar da memória
    unset($queryAux);

    echo '<div class="panel-group espacamento-painel-dropdown-historico-eventos" id="historico" role="tablist" aria-multiselectable = "true">';
    foreach ($arrAnosPublicados as $anoPublicacao) {

        if ($anoPublicacao !== $ultimoAno) {
            ?>
                <div class ="panel panel-default painel-historico-eventos">
                    <div class = "panel-heading caixa-dropdown-historico-eventos <?= $aryDadosCategoria['background-color_css']; ?>" id = "heading<?= $anoPublicacao; ?>" >
                        <a role="button" class="accordion-toggle <?= ($count == 0) ? "" : "collapsed"; ?>" data-toggle = "collapse" data-parent="#historico" href="#collapse<?= $anoPublicacao; ?>">
                            <h3 class = "panel-title text-center ano-historico-eventos " >
                                <?= $anoPublicacao; ?>
                            </h3>
                        </a>
                    </div>
                    <div id="collapse<?= $anoPublicacao; ?>" class="panel-collapse collapse <?= ($count == 0) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="heading<?= $anoPublicacao; ?>">
                        <div class="panel-body espacamento-corpo-painel-historico-eventos caixa-dropdown-galeria" >
                            <div class="row">
                                <?php
                                while ($query->have_posts()) {
                                    $query->the_post();

                                    $anoFim = null;
                                    $anoFim = date('Y', strtotime(get_field("data_fim_area_2")));

                                    if ($anoFim == $anoPublicacao) {

                                        /* =======================================================================================================	
                                          '* Exibe Conteúdo do histórico
                                          '======================================================================================================== */

                                        include(get_template_directory() . "-child/includes/conteudo-historico.php");
                                    } //if ($anoFim == $anoPublicacao) {

                                    unset($anoFim); //evitar erros de sujeira na memória
                                } //while ($query->have_posts()) {
                                ?>
                            </div>        
                        </div>
                    </div>
                </div>
            <?php
            $ultimoAno = $anoPublicacao;
        } //if ($anoPublicacao !== $ultimoAno) {
        $count++; //controlar o primeiro registro
    } //foreach ($arrAnosPublicados as $anoPublicacao) {
    echo '</div>';
    
} //if ($query->have_posts()) {

unset($query);
unset($arrAnosPublicados);
?>
<!--
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                
                
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                            </a>
                        </div>
                        <div id="collapse<?= $anoPublicacao; ?>" class="panel-collapse collapse <?= ($count == 0) ? "in" : ""; ?>" role="tabpanel" aria-labelledby="heading<?= $anoPublicacao; ?>">
                            <div class="panel-body espacamento-corpo-painel-historico-eventos caixa-dropdown-galeria" >
                                <div class="row">
                                    <?php
                                    while ($query->have_posts()) {
                                        $query->the_post();
                                        $anoFim = null;
                                        $anoFim = date('Y', strtotime(get_field("data_fim_area_2")));
                                        if ($anoFim == $anoPublicacao) {
                                            /* =======================================================================================================	
                                            '* Exibe Conteúdo do histórico de eventos
                                            '======================================================================================================== */
                                            include(get_template_directory() . "-child/includes/conteudo-historico.php");
                                        } //if ($anoFim == $anoPublicacao) {
                                        unset($anoFim); //evitar erros de sujeira na memória
                                    } //while ($query->have_posts()) {
                                    ?>
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $ultimoAno = $anoPublicacao;
            } //if ($anoPublicacao !== $ultimoAno) {
            $count++; //controlar o primeiro registro
        } //foreach ($arrAnosPublicados as $anoPublicacao) {
    }else{
        echo "Nenhum histórico de evento encontrado.";
    } //if ($query->have_posts()) {

    unset($query);
    unset($arrAnosPublicados);
    
    //> Restaura os dados originais do post
    wp_reset_postdata();
?>
