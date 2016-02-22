	<?php

	include(get_template_directory() . "-child/includes/complementar.php");


	                
		echo '<div id="logo-area-conteudo"><img src="http://placehold.it/200x70" alt="aaa" title="aa" width="200"></div>';
	
	
	echo '<ul class="nav nav-tabs nav-stacked menu-principal-area-conteudo">';
        
        
	/*=================================================================================================================	
	'* Retorna o id da tag acessada.
	'=================================================================================================================*/
        ?>
<ul class="menu-lateral-agenda">       
    <a href="#" ><li class="todas list-unstyled fonte-menu-lateral-agenda " projetos="" value="todas"><font color="#DFE0E1 ">todas as áreas</font>
                </li>	</a>
        <?php
                if ($objCategoriasFilhasProjeto) {
                        $count = 0;
                        /* =================================================================================================================	
                          '* Retorna a relação de categorias filhas de projeto, com imagem vinculada
                          '================================================================================================================= */
                        $classProjeto = null;
                        
                        
                        foreach ($objCategoriasFilhasProjeto as $term) {
                           
                            $corProjeto = get_field('cor_projeto_area', 'category_' . $term->term_id);
                            if (!empty($corProjeto)) {
                                $classProjeto = $term->slug . '_color ';
                            } else {
                                $classProjeto = 'categoria_padrao_color ';
                            }
                            echo '<a href="#"><li class="' . $classProjeto . 'list-unstyled fonte-menu-lateral-agenda" projetos="'.$term->slug.'" name="projetos[]" value="' . $term->term_id . '">' . $term->name . '</li></a>';
                        }
                }
                    ?>				
                </ul>
	<?php		
	echo '</ul>';                    
	
	?>
