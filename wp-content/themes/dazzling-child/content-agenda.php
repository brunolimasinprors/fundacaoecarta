<?php
    include(get_template_directory() . "-child/includes/complementar.php");
    /*=================================================================================================================	
    '* Retorna os posts de <agenda> dos eventos já realizados, com da <data fim> inferior a <data atual> do servidor.
    '=================================================================================================================*/						
    $args = array(
        'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
        'post_status'=> 'publish', //> Exibir post com a situação publicado				
        'meta_query' => array(
            //> Data fim do evento maior/igual a data hora atual
            array(
                'key'		=> 'data_fim_area_2',
                'compare'	=> '>=',
                'value'		=> date('Ymd') //> Data Atual
            )
        ),		
        'meta_key' => 'data_inicio_area_2', //> Ordenado pela <data de início> crescente.
        'orderby' => 'meta_value_num',
        'order' => 'ASC'	
    );			
    $query = new WP_Query($args);	
    $Imagens = null;
    $Conteudo = null;
    $objImagem = null;
    $mensagemNenhumEvento = "Nenhum evento cadastrado.";
    $count = 0;	
    if ($query->have_posts()){
        while ($query->have_posts() ) {
            $query->the_post();
            $idCategoriaPrincipal = retornaIdCategoriaPrincipalPost($post->ID);							
            $aryDadosCategoria = retornaLayoutCategoriaPrincipal($idCategoriaPrincipal);                
            /*=======================================================================================================	
            '* Exibe Conteúdo agenda
            '========================================================================================================*/							
            include(get_template_directory() . "-child/includes/conteudo-agenda.php");
            $count ++;
        }
    }else{
         $Conteudo .= '<span class="mensagem-agenda">'.$mensagemNenhumEvento.'</span>';
        
    }
    
    $Conteudo .= '<input type="hidden" id="mensagem-agenda-nenhum-evento" value="'.$mensagemNenhumEvento.'">';
    
    echo $Conteudo;    
    //> Restaura os dados originais do post
    wp_reset_postdata();
?>