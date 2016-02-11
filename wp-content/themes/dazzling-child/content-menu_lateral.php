	<?php

	include(get_template_directory() . "-child/includes/complementar.php");


	if (!empty($imagemCategoria)){                    
		echo '<div id="logo-area-conteudo"><img src="'.$imagemCategoria.'" alt="'.$tituloCategoria.'" title="'.$tituloCategoria.'" width="200"></div>';
	}
	
	echo '<ul class="nav nav-tabs nav-stacked menu-principal-area-conteudo">';
	/*=================================================================================================================	
	'* Retorna o id da tag acessada.
	'=================================================================================================================*/					
	if ($aryTags){					  
		foreach ($aryTags as $tag){
			/*=================================================================================================================	
			'* Destaca a tag do post acessado.
			'=================================================================================================================*/					
			$cssLinkAcessado = null;
			if ($tag->tag_slug == $tagSlugAcessada)
				$cssLinkAcessado = 	$cssDestacarLink." ".$cssColorCategoria;
			
			echo '<li><a class="'.$cssLinkCategoria." ".$cssLinkAcessado.'" href="'.retornaUrlTag($tag->tag_slug,$urlCategorias).'">'.$tag->tag_name.'</a></li>';
			
		}
	}
	echo '</ul>';                    
	
	?>
