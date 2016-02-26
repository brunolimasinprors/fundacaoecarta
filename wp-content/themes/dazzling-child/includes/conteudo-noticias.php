 <?php

    

    $Dia = get_the_time('j', $post->ID);
    $Mes = get_the_time('F', $post->ID);
    $Ano = get_the_time('Y', $post->ID);
    $objImagem = get_field('imagem_post');
    $creditoImagem = retornaPadraoTituloImagem($objImagem);
    
  $Conteudo = null;
   

   $Conteudo .= '<div class="caixa-noticias" >';     
    if ($objImagem){										
          $Conteudo .= '<img class="img-responsive imagem-noticias" src="'.$objImagem["url"].'"  alt="'.$creditoImagem.'"  title="'.$creditoImagem.'" width="130"/>';
      }	
      
      $Conteudo .= '<div class="box-titulo-noticias">';	
       $Conteudo .= '<div class="icones-apoio-noticias">';
            $Conteudo .= '<a href="#" class="icones-noticias"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a>';										
            $Conteudo .= '<a href="#" class="icones-noticias"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a>';
            $Conteudo .= '<a href="#" class="icones-noticias"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a>';
         $Conteudo .= '</div>';
         
          $Conteudo .= ' <h4 class="titulo-noticias">'.get_field('chamada_post').'</h4>';
          $Conteudo .= '<h5 class="data-noticia">'.$Dia.' de '.$Mes. ' de '.$Ano. '</h5>';
         
          $Conteudo .= '</div>';
          
      $Conteudo .= '<a href="'.get_permalink().'">';
      $Conteudo .= '<div class="caixa-descricao-noticias">';										
            $Conteudo .=' <p>'.get_field('linha_de_apoio_post').'. <span>(leia mais)</span></p>';        		
      $Conteudo .= '</div>';	
      $Conteudo .= '</a>';
       
				
    $Conteudo .= '</div>';
    
    

   echo $Conteudo;      
    
     
     
?>

