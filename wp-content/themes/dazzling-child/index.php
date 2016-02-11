<?php

 /**
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
 
//> INCLUI CABEÇALHO 
get_header(); ?>	

            
          <div id="primary" class="content-area area1 col-sm-12 col-md-7">
            <?php            
            /* 
             * Exibe CARROUSEL de chamadas principais
             *				>> ÁREA 1 / CHAMADAS PRINCIPAIS
             */
            get_template_part('content-chamadasprincipaiscapa', get_post_format());		
            ?>
          </div>
          

	<?php            
	/* 
	 * Exibe a relação de eventos da agenda
     *				>> ÁREA 2 / | AGENDA
	*/
	get_template_part('content-area2_agenda_capa', get_post_format());		
	?>





	<?php            
    /* 
     * Exibe a relação de destaques na capa do site 
     *				>> ÁREA 3 / | DESTAQUES
     */
    get_template_part('content-area3_destaques_capa', get_post_format());		
    ?>






	<?php            
	/* 
	 * * Exibe a relação de projetos na capa do site 
	 *				>> ÁREA 4 / PROJETOS
	 */
	get_template_part('content-area4_projetos_capa', get_post_format());		
	?>

    
        
        

              


<?php get_footer(); ?>