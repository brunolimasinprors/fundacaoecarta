<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" >

    <?php
$objImagem = get_field('imagem_post');
$creditoImagem = retornaPadraoTituloImagem($objImagem);
$Conteudo = null;

 $Conteudo .= '   <a href="'.get_permalink().'">';
      $Conteudo .= '  <div class="media">';
       if ($objImagem){	
         
           
            
              $Conteudo .= '  <img class="media-object img-responsive imagem-noticias" src="'.$objImagem["url"].'"  alt="'.$creditoImagem.'"  title="'.$creditoImagem.'" width="130">';
             
            
           
            }
           $Conteudo .= '  <div class="media-body">';
              $Conteudo .= ' <h4 class="media-heading titulo-busca-conteudo">'.get_field('chamada_post').'</h4>';
               $Conteudo .=' <p class="conteudo-linha-apoio-busca">'.get_field('linha_de_apoio_post').'</p>';
            $Conteudo .= ' </div>';
         $Conteudo .= ' </div>';
	 $Conteudo .= '  </a>';	
echo $Conteudo;
?>
	

	

</article><!-- #post-## -->
<?php
echo '<hr class="linha-h4-busca"/>';

?>

