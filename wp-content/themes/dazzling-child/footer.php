<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package dazzling
 * @subpackage dazzling-child
 */
include(get_template_directory() . "-child/includes/complementar.php");
?>
</div><!-- close .row -->
</div><!-- close .container -->
</div><!-- close .site-content -->

        <div id="footer-area">
            <div class="rodape area5">
                <?php            
                /* 
                 * * Exibe o endereço na capa do site 
                 *				>> ÁREA 5 / ENDEREÇO
                 */
                get_template_part('content-area5_endereco_capa', get_post_format());		
                ?>
            </div>

            <div class="row">
                <div class="content-area col-lg-2 col-xs-6 col-sm-3">
                    <ul class="list-unstyled">                      
                        <?php exibeTagsMenuRodape($objCategoriaAFundacao); ?>					
                    </ul>
                </div>

                <div class="content-area col-lg-2 col-xs-6 col-sm-3">		        
                    <ul class="list-unstyled"> 
                        <?php exibeTagsMenuRodape($objCategoriaParcerias); ?>					                
                    </ul>
                </div>

                <div class="content-area col-lg-2 col-xs-6 col-sm-3">	            
                    <ul class="list-unstyled"> 				
                        <li class="titulo-item-rodape">projetos</li> 
                        <?php
                        if ($objCategoriasFilhasProjeto) {
                            foreach ($objCategoriasFilhasProjeto as $term) {
                                echo '<li> <a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
                            } //> foreach($pObjCategoriasFilhasProjeto as $term) 
                        } //> if ($pObjCategoriasFilhasProjeto){
                        ?>
                    </ul>
                </div>

                <div class="content-area col-lg-2 col-xs-6 col-sm-3">        
                    <ul class="list-unstyled"> 
                        <li class="titulo-item-rodape">contato</li>                    
                        <li><a href="#">direção executiva</a></li>
                        <li><a href="#">coordenação de projetos</a></li> 
                        <li><a href="#">assessoria de imprensa</a></li> 
                        <li><a href="#">secretaria</a></li>                       
                    </ul>
                </div>

                <div class="content-area col-lg-2 col-xs-6 col-sm-3">	
                    <span class="titulo-item-rodape list-unstyled">siga</span>
                    <ul class="list-inline itens-siga-rodape"> 
                        <li><a href="#"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a></li>
                        <li><a href="#"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a></li>
                        <li><a href="#"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a></li>
                        <li><a href="#"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a></li>
                        <li><a href="#"><img class="icones-siga-rodape" src="http://placehold.it/20x20" /></a></li>
                    </ul>
                </div>

                <div class="content-area col-lg-2 col-xs-6 col-sm-3">            
                    <?php            
                    /* 
                     * * Exibe o apoiadores na capa do site 
                     *				>> ÁREA 6 / APOIO
                     */
                    get_template_part('content-area6_apoio_capa', get_post_format());		
                    ?>
                </div>
            </div>
            <div class="row">		
                <div class="content-area col-lg-12 col-xs-12 col-sm-12">    
                    <ul class="list-unstyled">       
                        <li class="titulo-item-rodape">informativos</li>               
                        <li>cadastre-se e receba a programação</li>               
                    </ul>
                </div>
            </div>
            <div class="row">        
                <div class="content-area col-lg-12 col-xs-12 col-sm-12">    
                    <ul class="list-unstyled">       
                        <li class="titulo-item-rodape">
                            <div class="fundo-caixa-icone-estrela-rodape text-center">
                                <span class="glyphicon glyphicon-star icone-estrela-rodape"> </span>
                            </div>
                            áreas de interesse
                        </li>				
                        <li>Selecione as áreas de seu interesse para receber periodicamente e-mails com as novidades da Ecarta.</li>
                    </ul>
                </div>
            </div>
            <form name="frmEmailsInformativo" id="frmEmailsInformativo" class="form-inline " action="<?= get_stylesheet_directory_uri() ?>/sp_emails_informativo.php">
                <div class="row">
                    <div class="content-area col-lg-12 col-xs-12 col-sm-12">    
                        <ul class="list-inline itens-projeto-form-rodape fonte-areas-rodape">       
                            <li class="fonte-titulo-rodape">
                                <input class="todos-projetos-rodape" type="checkbox" value="todas"><font color="#DFE0E1 ">todas as áreas</font>
                            </li>	
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
                                    echo '<li class="' . $classProjeto . '"><input name="projetos[]" class="caixaCheckbox" type="checkbox" value="' . $term->term_id . '">' . $term->name . '</li>';
                                }
                            }
                            ?>				
                        </ul>
                    </div>
                </div>
                <div class="row">	  
                    <div class="content-area col-lg-12 col-xs-12 col-sm-12">    
                        <div class="form-group">
                            <input  id="txtNome" name="txtNome" type="text" class="form-control input-form-rodape" placeholder="nome" >
                        </div>
                        <div class="form-group">
                            <input id="txtEmail" name="txtEmail" type="text" class="form-control input-form-rodape" placeholder="e-mail">
                        </div>
                        <div class="form-group">
                            <button id="btCadastrar" name="btCadastrar" type="button" class="btn button-form-rodape">cadastrar</button>
                            <div style="display: inline-flex; font-size: 10px;line-height: 10px;">
                                Clicando em cadastrar você corcorda em receber por e-mail<br/>as novidades da Ecarta (seu e-mail não será compartilhado com terceiros)
                            </div>
                        </div>
                    </div>
                    <div class="content-area col-lg-6 col-xs-12 col-sm-12 " >  
                        <div class="alert alert-danger alert-dismissible alerta-rodape" role="alert"  >
                            <button type="button" class="close botao-fecha-alerta" ><span aria-hidden="true">×</span></button>
                            <p id="campo-preenchimento-rodape" class="campo-preenchimento-rodape"></p>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">			
                <!--
                container footer-inner
                -->
                <div class="copyright-ropape">
                    <a href="http://www.fundacaoecarta.org.br/" title="Fundação Ecarta">
                        © Copyright 2016, Fundação Ecarta - Todos os direitos reservados.</a><br>Tema baseado em  <a target="_blank" href="https://colorlib.com/wp/" title="Dazzling Theme by Colorlib">Dazzling</a> &amp; <a target="_blank" href="http://wordpress.org/">  WordPress.            
                    </a>
                </div>
            </div>	
        </div>

    </div>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
