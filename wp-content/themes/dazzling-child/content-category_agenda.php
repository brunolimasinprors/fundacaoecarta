<?php
    include(get_template_directory() . "-child/includes/complementar.php");
    
    /*=================================================================================================================	
    '* Retorna a relação de posts pertencentes a <<categoria principal acessada>>
    '=================================================================================================================*/						
    $args = array(
        'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
        'post_status'=> 'publish', //> Exibir post com a situação publicado				
        'cat' => $idCategoriaPrincipalAcessada, //> id categoria		
        'meta_query' => array(
            array(
                'key'		=> 'data_fim_area_2',
                'compare'	=> '>=',
                'value'		=> date('Ymd') //> Data Atual
            )
        ),		
        'meta_key' => 'data_inicio_area_2', // name of custom field
        'orderby' => 'meta_value_num',
        'order' => 'ASC'	
    );			

    $query = new WP_Query($args);
    $Imagens = null;
    $Conteudo = null;
    $objImagem = null;

    $count = 0;	
    if ($query->have_posts()){
        while ( $query->have_posts() ) {
            $query->the_post();
            /*=======================================================================================================	
            '* Exibe Conteúdo agenda
            '========================================================================================================*/							
            include(get_template_directory() . "-child/includes/conteudo-agenda.php");
            $count ++;
        }    
    }else{        
        $Conteudo .= "Nenhum evento cadastrado.";
    }
    echo $Conteudo;
    
    //> Restaura os dados originais do post
    wp_reset_postdata();
?>
