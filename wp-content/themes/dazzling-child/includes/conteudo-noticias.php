 <?php

    

    $Dia = get_the_time('j', $post->ID);
    $Mes = get_the_time('F', $post->ID);
    $Ano = get_the_time('Y', $post->ID);
    $objImagem = get_field('imagem_post');
    $creditoImagem = retornaPadraoTituloImagem($objImagem);
    
  $Conteudo = null;
   
  $Conteudo .= '<div  class="area-total-noticias media">';     
    
  $Conteudo .= ' <a href="'.get_permalink().'">';
      if ($objImagem){										
          $Conteudo .= '<img class="img-responsive imagem-noticias" src="'.$objImagem["url"].'"  alt="'.$creditoImagem.'"  title="'.$creditoImagem.'" width="130"/>';
      }	else {
          $Conteudo .= '<div class="sem-imagem"></div>';
      }
       $Conteudo .= ' </a>';
      $Conteudo .= '<div class="box-titulo-noticias">';

         $Conteudo .= ' <a href="'.get_permalink().'">';
          $Conteudo .= ' <h5 class="titulo-noticias">'.get_field('chamada_post').'</h5>';
          $Conteudo .= '<h6 class="data-noticia">'.$Dia.' de '.$Mes. ' de '.$Ano. '</h6>';
         $Conteudo .= ' </a>';
          $Conteudo .= '</div>';
          
      $Conteudo .= '<a href="'.get_permalink().'">';
      $Conteudo .= '<div class="caixa-descricao-noticias">';										
            $Conteudo .=' <p>'.get_field('linha_de_apoio_post').'. <span>(leia mais)</span></p>';        		
      $Conteudo .= '</div>';	
      $Conteudo .= '</a>';
       
				
    $Conteudo .= '</div>';    
   
     ;   
   echo $Conteudo;   
     
     
?>

