<?php
    include(get_template_directory() . "-child/includes/complementar.php");
    $args = array(
        'post_type' => 'area2_post_type', //> Tipo de post <area2_post_type>
        'post_status'=> 'publish', //> Exibir post com a situação publicado				
        'meta_query' => array(
            array(
                'key'		=> 'data_fim_area_2',
                'compare'	=> '>=',
                'value'		=> date('Ymd') //> Data Atual
            )
        ),		
    );	
        
    $aryCidades = array();
    $aryMeses = array();
    $query = new WP_Query($args);
    /*
    * Adicionar a relação de cidades e meses em arrays separados
    */
    while ( $query->have_posts() ) {
        $query->the_post();
        $aryCidades[] = get_field('cidade_area_2');
        $aryMeses[] = retornaMesPorExtenso(date("n",strtotime(get_field("data_inicio_area_2"))));
    }
    //> Restaura os dados originais do post
    wp_reset_postdata();

    $aryCidades = array_unique($aryCidades); //> remove duplicidades do array
    $aryMeses = array_unique($aryMeses); //> remove duplicidades do array
    ?>

    <div>
        <form>
            <label style="margin-right: 20px;"> Filtre por </label>   
            <select class="menu-select-agenda cidades-agenda ">
                <option value="">Todos locais</option>
                <?php
                foreach ($aryCidades as $cidade) {
                    echo '<option value="'.$cidade.'" >'.$cidade.'</option>';
                }
                ?>
            </select>
            <select class="menu-select-agenda mes-agenda">
                <option value="">Todos meses</option>   
                <?php  
                foreach( $aryMeses as $Mes ) {
                  echo '<option value="'.$Mes.'" >'.$Mes.'';
                }
                ?>
            </select>
           <input class="btn botao-filtro-agenda" type="button" value="Filtrar">           
        </form>
    </div>        