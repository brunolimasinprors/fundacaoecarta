<?php
/* =======================================================================================================	
  '* Exibe Conteúdo do histórico
  '======================================================================================================== */
/* retirando variáveis da memória */
$objImagem     = null;
$urlImagem     = null;
$creditoImagem = null;
$chamada       = null;
$data_fim_area = null;
$cidade        = null;
$dia           = null;
$idMes         = null;
$idMes         = null;
$anoFim        = null;
$mesPorExtenso = null;

/* Retorno as informações que serão exibidas */
$link = get_field("link_area_2");
$objImagem = get_field('imagem_area_2');


$urlImagem = $objImagem["url"];
$creditoImagem = retornaPadraoTituloImagem($objImagem);


$chamada       = get_field("chamada_area_2");
$data_fim_area = get_field("data_fim_area_2");
$cidade        = get_field('cidade_area_2');

/* recupero as informações da data para montar o layout */
$dia    = date('d', strtotime($data_fim_area));
$idMes  = date('m', strtotime($data_fim_area));
$idMes  = (int) $idMes; //converte para inteiro
$anoFim = date('Y', strtotime($data_fim_area));

$mesPorExtenso = retornaMesPorExtenso($idMes);
?>


<div class="col-lg-2 col-sm-4 col-md-3 col-xs-6">
    <a href="<?= $link; ?>" target="blank">
        <div class="thumbnail espacamento-eventos-historico-eventos">
            <div class="caption espacamento-linhas-historico-eventos">

                <img class="img-responsive imagem-agenda" src="<?= $urlImagem; ?>"  alt="<?= $creditoImagem; ?>"  title="<?= $creditoImagem; ?>" width="150" height="100"  />
                <h6 class="espacamento-linhas-historico-eventos"><?= $chamada; ?></h6>

                <p><?= $dia; ?> de <?= $mesPorExtenso; ?></p>
                <p><?= $cidade; ?></p>

            </div>
        </div>
    </a>
</div>

<?php
/* retirando variáveis da memória */
unset($objImagem);
unset($urlImagem);
unset($creditoImagem);
unset($chamada);
unset($data_fim_area);
unset($cidade);
unset($dia);
unset($idMes);
unset($idMes);
unset($anoFim);
unset($mesPorExtenso);
?>