<?php
    /*=================================================================================================================	
    '* Retorna os posts de destaques da área <area3_post_type>.  
    '=================================================================================================================*/						
    $args = array(
        'post_type' => 'area3_post_type', //> Tipo de post <area1_post_type>
        'post_status'=> 'publish', //> Exibir post com a situação publicado
        'orderby'=> 'menu_order', //> Aplica ordenação informada no painel de controle.
        'order' => 'asc'
    );			
    $query = new WP_Query($args);
    $Imagens = null;
    $Conteudo = null;
    $objImagem = null;
    if ( $query->have_posts()){
        $Conteudo .= '<div class="chamadas-principais area3">';   
            $Conteudo .= '<div class="row">';
                $Conteudo .= '<div class="content-area col-sm-12 col-md-12">';
                        $Conteudo .= '<hr class="linha-h4"/>';
                        $Conteudo .= '<h4 class="titulo-linha-h4">destaques</h4>';
                $Conteudo .= '</div>';
            $Conteudo .= '</div>';
            $Conteudo .= '<div class="slide-carousel-horizontal-capa carousel slide" data-ride="carousel" data-type="multi" id="area-slide-carousel-destaques-capa" data-interval="0">';
                $Conteudo .= '<div class="carousel-inner">';
                $i = 0;
                while ( $query->have_posts() ) {			
                    $query->the_post();
                    $objImagem = get_field('imagem_area_3');
                    /*=======================================================================================================	
                    '* Exibe imagem do campo personalizado
                    '========================================================================================================*/		
                    $tituloImagem = retornaPadraoTituloImagem($objImagem);
                    if ($i == 0){
                        $selecao = " active";	
                    }else{
                        $selecao = "";	
                    }
                    $Conteudo .= '<div class="item'.$selecao.'">';
                        $Conteudo .= '<div class="col-md-4 col-sm-12">';
                            $Conteudo .= '<div class="thumbnail">';
                                $Imagens = '<a href="'.get_field("link_post_area_3").'"><img src="'.$objImagem["url"].'"  alt="'.$tituloImagem.'"  title="'.$tituloImagem.'"  width="'.$objImagem["sizes"]["medium-width"].'" height="'.$objImagem["sizes"]["medium-height"].'" class="img-responsive img-area3_destaques_capa"  /></a>';					
                                $Conteudo .= $Imagens;
                                $Conteudo .= '<div class="caption text-justify">';
                                    $Conteudo .= '<a href="'.get_field("link_post_area_3").'">';
                                            $Conteudo .= '<p>'.get_field("chamada_area_3").'</p>';
                                    $Conteudo .= '</a>';	        
                                $Conteudo .= '</div>';
                            $Conteudo .= '</div>';
                        $Conteudo .= '</div>';
                    $Conteudo .= '</div>';					
                    $i ++;	
                } //> while ( $query->have_posts() ) {
                /* Mantem o espaço*/
                /*
                for ($i = $query->post_count; $i < $args['showposts']; $i ++){ 
                        $Conteudo .= '<div class="col-sm-12 col-md-4">';
                        $Conteudo .= '</div>';
                }
                */
                $Conteudo .= ' </div>';	
                $Conteudo .= ' <a class="left carousel-control" href="#area-slide-carousel-destaques-capa" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>';
                $Conteudo .= '<a class="right carousel-control" href="#area-slide-carousel-destaques-capa" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>';
            $Conteudo .= ' </div>';
        $Conteudo .= ' </div>';
    } //> if ( $query->have_posts()){
    echo $Conteudo;

    //> Restaura os dados originais do post
    wp_reset_postdata();
?>