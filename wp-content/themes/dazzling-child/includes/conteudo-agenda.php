<?php

    $objImagem = get_field('imagem_area_2');
    $creditoImagem = retornaPadraoTituloImagem($objImagem);


    $dataInicio =  date("d/m/Y",strtotime(get_field("data_inicio_area_2")));
    $dataFim =  date('d/m/Y', strtotime(get_field("data_fim_area_2")));
    $Mes = retornaMesPorExtenso(date("n",strtotime(get_field("data_inicio_area_2"))));

    if ($dataInicio != $dataFim){
            $strComplementoData = "Até";	
            $dataExibicao = date("d/m",strtotime(get_field("data_fim_area_2")));

    }else{
            $diaSemana = date("w",strtotime(get_field("data_inicio_area_2")));
            $totalCaracteresDiaSemana = 3;
            if ($diaSemana == 6){ //> Ascento do sábado
                    $totalCaracteresDiaSemana = 4; 
            }

            $strComplementoData = substr(retornaDiaSemanaPorExtenso($diaSemana), 0, $totalCaracteresDiaSemana);
            $dataExibicao = date("d/m",strtotime(get_field("data_inicio_area_2")));															
    }

    /*=======================================================================================================	
    '* Seta a classe <active> o primeiro evento da agenda a ser exibido.
    '========================================================================================================*/							
    $ativo = "";
    if ($count == 0){
            $ativo = "active";
    }


    $Conteudo .= '<div class="media media-agenda box-item-agenda" projeto="'.$aryDadosCategoria["slug"].'" cidade="'.get_field('cidade_area_2').'" mes="'.$Mes.'">';
      $Conteudo .= '<a href="'.get_field("link_area_2").'" class="link-agenda">';									
      $Conteudo .= '<div class="media-left">';									
	  
        $Conteudo .= '<div class="panel panel-default panel-agenda '.$aryDadosCategoria["border-color_css"].'">';
          $Conteudo .= '<div class="panel-body data-agenda '.$aryDadosCategoria["background-color_css"].'">';										
            $Conteudo .= '<small>'.$strComplementoData.'<br/>';
            $Conteudo .= $dataExibicao.' </small>';
          $Conteudo .= '</div>';
          $Conteudo .= '<div class="panel-footer hora-agenda '.$aryDadosCategoria["border-color_css"].'">';
          $Conteudo .= '<small>'.get_field('horario_inicio_area_2').'</small>';
          $Conteudo .= '</div>';
        $Conteudo .= '</div>';							
      $Conteudo .= '</div>';
      $Conteudo .= '<div class="media-body media-body-agenda">';

        if ($objImagem){										
            $Conteudo .= '<img class="img-responsive imagem-agenda" src="'.$objImagem["url"].'"  alt="'.$creditoImagem.'"  title="'.$creditoImagem.'" width="70"  />';
        }		
        
            $Conteudo .= '<h4 class="media-heading media-heading-agenda '.$aryDadosCategoria["color_css"].'">'.mb_strtolower(get_field('cartola_area_2'), 'UTF-8').'</h4>';	
                $Conteudo .= '<div style="display: table-cell;">';
                    $Conteudo .= '<small>'.get_field('chamada_area_2').'</small><br/>';
                    $Conteudo .= '<small class="small-cidade-agenda">'.get_field('cidade_area_2').'</small>';
                $Conteudo .= '</div>';
        
      $Conteudo .= '</div>';								  
        $Conteudo .= '</a>';										  	
        $Conteudo .= '<hr class="linha-h4-agenda"/>';								
    $Conteudo .= '</div>';
	
?>