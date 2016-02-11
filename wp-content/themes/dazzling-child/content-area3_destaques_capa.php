<?php
	$args = array(
		'post_type' => 'area3_post_type', //> Tipo de post <area1_post_type>
		'showposts' => 10,   //> Quantidade maxima de  posts a serem exibidos					
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
			
			
			
			
			//$Conteudo .= '<div class="row area3-destaques">';
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
									//$Conteudo .= '<p>'.get_field("chamada_area_3").'</p>';
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
	
?>








<!--
    <div class="chamadas-principais area3">
        <div class="row">
            <div class="content-area col-sm-12 col-md-12">
                <hr class="linha-h4"/>
                <h4 class="titulo-linha-h4">destaques</h4>
            </div>
        </div>


        <div class="slide-carousel-horizontal-capa carousel slide" data-ride="carousel" data-type="multi" id="area-slide-carousel-destaques-capa" data-interval="0">
          <div class="carousel-inner">
            <div class="item active">
              <div class="col-md-4 col-sm-12">
                <div class="thumbnail">
                 <a href="http://www.fundacaoecarta.org.br/musica/itinerante_alegrete_2015.asp"><img src="http://localhost/fundacaoecarta/wp-content/uploads/2015/12/img7.jpg" alt="Marcello Caminha | Foto: Igor Sperotto" title="Marcello Caminha | Foto: Igor Sperotto" width="300" height="201" class="img-responsive img-area3_destaques_capa"></a>
                 <div class="caption text-justify">
                    <a href="http://www.fundacaoecarta.org.br/musica/itinerante_alegrete_2015.asp">
                       <p>Marcello Caminha apresenta Influência</p>
                    </a>
                 </div>
                </div>
              
              
              </div>
            </div>
            <div class="item">
              <div class="col-md-4 col-sm-12">
                  <div class="thumbnail">
                     <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp"><img src="http://localhost/fundacaoecarta/wp-content/uploads/2015/12/nicola.jpg" alt="Nicola Spolidoro | Foto: Renata Massetti" title="Nicola Spolidoro | Foto: Renata Massetti" width="300" height="200" class="img-responsive img-area3_destaques_capa"></a>
                     <div class="caption text-justify">
                        <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp">
                           <p>Grupo formado por Rafael Marques (bateria), Carlos D’elia (contrabaixo), Matheus Kléber (teclado e acordeom) e Nicola Spolidoro (violão e guitarra).</p>
                        </a>
                     </div>
                  </div>      
              </div>
            </div>
            <div class="item">
              <div class="col-md-4 col-sm-12">
                  <div class="thumbnail">
                     <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp"><img src="http://localhost/fundacaoecarta/wp-content/uploads/2015/12/loma.jpg" alt="loma | Foto: Rosane Scherer" title="loma | Foto: Rosane Scherer" width="300" height="225" class="img-responsive img-area3_destaques_capa"></a>
                     <div class="caption text-justify">
                        <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp">
                           <p>Loma, morena maçambiqueira Acompanhada por Catuípe (violão)</p>
                        </a>
                     </div>
                  </div>      
              
              </div>
            </div>
            <div class="item">
              <div class="col-md-4 col-sm-12">
                  <div class="thumbnail">
                     <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp"><img src="http://localhost/fundacaoecarta/wp-content/uploads/2015/12/nicola.jpg" alt="Nicola Spolidoro | Foto: Renata Massetti" title="Nicola Spolidoro | Foto: Renata Massetti" width="300" height="200" class="img-responsive img-area3_destaques_capa"></a>
                     <div class="caption text-justify">
                        <a href="http://www.fundacaoecarta.org.br/musica/itinerante_santa_cruz_do_sul_2013.asp">
                           <p>Grupo formado por Rafael Marques (bateria), Carlos D’elia (contrabaixo), Matheus Kléber (teclado e acordeom) e Nicola Spolidoro (violão e guitarra).</p>
                        </a>
                     </div>
                  </div>
              </div>
            </div>
        
          </div>
          <a class="left carousel-control" href="#area-slide-carousel-destaques-capa" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="right carousel-control" href="#area-slide-carousel-destaques-capa" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div>
</div>
-->

