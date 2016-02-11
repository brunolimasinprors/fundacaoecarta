<?php
    $Conteudo .= '<div class="media media-agenda box-item-agenda">';
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