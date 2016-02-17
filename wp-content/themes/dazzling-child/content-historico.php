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

    foreach ($arrAnosPublicados as $anoPublicacao) {

        if ($anoPublicacao !== $ultimoAno) {
            ?>

            <div class = "panel-group espacamento-painel-dropdown-historico-eventos" id = "accordion" role = "tablist" aria-multiselectable = "true" >
                <div class = "panel panel-default painel-historico-eventos">

                    <div class = "panel-heading caixa-dropdown-historico-eventos " id = "heading<?= $anoPublicacao; ?>" >
                        <a class = "accordion-toggle" data-toggle = "collapse" data-parent = "#" href = "#collapse<?= $anoPublicacao; ?>">
                            <h3 class = "panel-title text-center ano-historico-eventos " >

                                <?= $anoPublicacao; ?>

                            </h3>
                        </a>
                    </div>
                    <div id="collapse<?= $anoPublicacao; ?>" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="heading<?= $anoPublicacao; ?>">
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

                                        $count++;
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
        
    } //foreach ($arrAnosPublicados as $anoPublicacao) {
    
} //if ($query->have_posts()) {

unset($query);
unset($arrAnosPublicados);

?>