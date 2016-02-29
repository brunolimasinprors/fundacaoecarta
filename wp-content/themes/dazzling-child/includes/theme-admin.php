<?php
/**
 * Customizações do tema para a área de admin
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
/* -------------------------------------------
        GERA HTML DA INTERFACE DE EDIÇÃO DA CAPA
-------------------------------------------*/
/*---------------------------------------------------*/
/* Cria modelo da página para edição da capa do site
/*---------------------------------------------------*/
function pagina_edicao_capa_callback() {
    ?>
    <style type='text/css'>

        div.updated {
            display: none !important;
        }

        .wrap div {
            cursor: pointer;
            position:absolute;
        }

        #capa-container {
            background: transparent url(<?php echo get_stylesheet_directory_uri(); ?>/imagens/capa_site.jpg) no-repeat !important;
            width: 1024px;
            height: 1373px;
        }
        
        #logo-pagina-principal {
            width: 295px;
            height: 115px;
            left: 0px;
            top: 0px;
            background-color:#5A0F0F;
            opacity: 0;
            color: #FFF;
            font-size: 32px;
            text-align: -webkit-center;
            vertical-align: middle;            
            line-height: 100px;				
        }

        #seo {
            width: 729px;
            height: 35px;
            left: 295px;
            top: 0px;
            background-color:#B3B300;
            opacity: 0;
            color: #FFF;
            font-size: 20px;
            text-align: -webkit-center;
            vertical-align: middle;            
            line-height: 35px;
            text-indent: 96px;
        }        
        
        #menu-topo-principal {
            width: 729px;
            height: 79px;
            left: 295px;
            top: 35px;
            background-color:#0099FF;
            opacity: 0;
            color: #FFF;
            font-size: 32px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 80px;				
        }


        

        #menu-topo-projetos {
            width: 1024px;
            height: 32px;
            left: 0px;
            top: 115px;
            background-color:#CC3300;
            opacity: 0;
            color: #FFF;
            font-size: 2em;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 1em;				
        }


        #area1 {
            width: 574PX;
            height: 385px;
            left: 31px;
            top: 169px;
            background-color:#339999;
            opacity: 0;
            color: #FFF;
            font-size: 68px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 150px;				
        }

        #area2 {
            width: 364px;
            height: 385px;
            left: 634px;
            top: 169px;
            background-color:#FF9900;
            opacity: 0;
            color: #FFF;
            font-size: 58px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 90px;				
        }


        #area3 {
            width: 967px;
            height: 291px;
            left: 31px;
            top: 586px;
            background-color:#00CC00;
            opacity: 0;
            color: #FFF;
            font-size: 68px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 250px;				
        }

        #area4 {
            width: 968px;
            height: 150px;
            left: 30px;
            top: 891px;
            background-color:#0066FF;
            opacity: 0;
            color: #fff;
            font-size: 68px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 130px;				
        }	

        #area5 {            
            width: 965px;
            height: 44px;
            left: 31px;
            top: 1070px;
            background-color:#2C8383;
            opacity: 0;
            color: #fff;
            font-size: 28px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 40px;				
        }	

        #area6 {
            width: 97px;
            height: 178px;
            left: 901px;
            top: 1114px;
            background-color:#660099;
            opacity: 0;
            color: #fff;
            font-size: 24px;
            text-align: -webkit-center;
            vertical-align: middle;
            line-height: 50px;				
        }	
        

        #logo-pagina-principal:hover, #seo:hover, #menu-topo-principal:hover, #menu-topo-projetos:hover, #area1:hover, #area2:hover, #area3:hover, #area4:hover, #area5:hover, #area6:hover{
            opacity: .75;
        }

    </style>

    
    
    <script>
        jQuery(function($) {
                $("#capa-container div").click(function() {
                        url = '<?php echo get_site_url(); ?>/wp-admin/' + $(this).attr('url');
                        window.location.href = url;
                });
        });
    </script>

<?php

    echo '<div class="wrap" style="height:1495px;"><div id="icon-tools" class="icon32"></div>';
    echo '<div id="capa-container">';
        echo '<div id="logo-pagina-principal" url="themes.php?page=custom-header">EDITAR LOGO</div>';
        echo '<div id="seo" url="edit.php?post_type=area0_post_type">EDITAR CRITÉRIOS BUSCADORES</div>';    
        echo '<div id="menu-topo-principal" url="nav-menus.php">EDITAR MENU PRINCIPAL</div>';    
        echo '<div id="menu-topo-projetos" url="edit-tags.php?taxonomy=category" >EDITAR MENU PROJETOS</div>';
        echo '<div id="area1" url="edit.php?post_type=area1_post_type" >EDITAR GALERIA DESTAQUES</div>';
        echo '<div id="area2" url="edit.php?post_type=area2_post_type">EDITAR DESTAQUES AGENDA</div>';	    
        echo '<div id="area3" url="edit.php?post_type=area3_post_type" >EDITAR DESTAQUES</div>';
        echo '<div id="area4" url="edit-tags.php?taxonomy=category" >EDITAR PROJETOS</div>';        
        echo '<div id="area5" url="edit.php?post_type=area5_post_type">EDITAR ENDEREÇO</div>';    
        echo '<div id="area6" url="edit.php?post_type=area6_post_type">EDITAR APOIOS</div>';    

    echo '</div></div>';
}
	
?>