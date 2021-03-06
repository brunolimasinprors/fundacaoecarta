jQuery(document).ready(function ($) {
    /*
		ÁREA 1 / CHAMADAS PRINCIPAIS (Carrossel)
	*/
    $('#chamadas-principais').carousel({
        interval: 9000 //> Tempo de transição entre as imagens em milisegundos <1000 milisegundos = 1 segundo>
    });

    /*
		ÁREA 2 / AGENDA
	*/
    $('#area-slide-carousel-agenda-capa .item').each(function () {
        var next = $(this).next();
        var limite;
        //> Total de Itens
        //alert($("#carousel-example-vertical .item").length);		
        //alert(next.length); //> quantidade de itens
        //alert($('div.active').index());
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        if ($("#area-slide-carousel-agenda-capa .item").length <= 2) {
            limite = 0;
        } else if ($("#area-slide-carousel-agenda-capa .item").length == 3) {
            limite = 1;
        } else {
            limite = 2;
        }
        for (var i = 0; i < limite; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });		
	
	/*
		ÁREA 3 / | DESTAQUES 
	*/
    $('#area-slide-carousel-destaques-capa[data-type="multi"] .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        for (var i = 0; i < 1; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });

	/*
		ÁREA 4 / PROJETOS
	*/
    $('#area-slide-carousel-projetos-capa[data-type="multi"] .item').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
        for (var i = 0; i < 2; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });

//
//    Formulario rodapé
//

    //> Seleciona todos os projetos 
    $(".todos-projetos-rodape").click(function () {
        $(".caixaCheckbox").each(function () {
            if ($(".todos-projetos-rodape").prop("checked")) {
                $(this).prop("checked", true);
            } else {
                $(this).prop("checked", false);
            }
        });
    });

    $("#btCadastrar").click(function () {
        var variavelControle = false;
        $(".campo-preenchimento-rodape").text("");
        //Para evitar conflito no layout da tag de retorno
        $('.alerta-rodape').hide();
        jQuery('.alerta-rodape').removeClass('alert-danger');
        jQuery('.alerta-rodape').removeClass('alert-success');
        $('.caixaCheckbox').each(function () {
            if ($(this).prop("checked") == true) {
                variavelControle = true;
                return;
            }
        });

        if (!variavelControle) {
            $(".campo-preenchimento-rodape").html("Selecione sua(s) <strong>área(s) de interesse</strong>. ");
            jQuery('.alerta-rodape').addClass('alert-danger');
            $('.alerta-rodape').show();
            return;
        }

        if ($("#txtNome").val() == "") {
            $(".campo-preenchimento-rodape").html("O campo <strong>nome</strong> é de preenchimento obrigatório. ");
            jQuery('.alerta-rodape').addClass('alert-danger');
            $('.alerta-rodape').show();
            return;
        }

        if ($("#txtEmail").val() == "") {
            $(".campo-preenchimento-rodape").html("O campo <strong>e-mail</strong> é de preenchimento obrigatório. ");
            jQuery('.alerta-rodape').addClass('alert-danger');
            $('.alerta-rodape').show();
        } else {
            var email = $("#txtEmail").val();
            if (!validarEmail(email)) {
                $(".campo-preenchimento-rodape").html("O endereço de e-mail informado é <strong>inválido</strong>.");
                jQuery('.alerta-rodape').addClass('alert-danger');
                $('.alerta-rodape').show();
                return;
            }
        }
        enviaDadosFormAjax('frmEmailsInformativo', null, 'campo-preenchimento-rodape');
    });

    $(".botao-fecha-alerta").click(function () {
        $('.alerta-rodape').hide();

    });

    //> Função que valida formato do Email
    function validarEmail(emailAddress) {
        var verifica = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return verifica.test(emailAddress);
    }

    $('#carousel-galeria-imagens').carousel({
        interval: false
    });

//
//      Galeria de imagens | Leonardo
//

    //> Determine o numero de imagens a serem exibidas embaixo da galeria de imagens
    $('#menuCarousel[data-type="multi"] .menu-galeria-imagem').each(function () {

        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < 5; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }


    });

//
//          Fim galeria de imagens
//

// ******************************************

//                                              
//     Agenda controle de filtros  | Leonardo  
//                                               

    //> Tempo de carregamento dos elementos da agenda
    var tempoCarregamento = 500;
    
    //> Mensagem a ser exibida caso não encontre nenhum evento 
    var msgNenhumEvento = $("#mensagem-agenda-nenhum-evento").val();
    
    //> Evento disparado ao clicar nos projetos laterais da agenda 
    $(".fonte-menu-lateral-agenda").click(function () {
        var nomeProjeto = $(this).attr("projetos");
        var cont = 0;
           
        //> Limpa o conteúdo da div de notificação
        $("div .area-exibir-agenda1").text("");
        $("div .mensagem-agenda").text("");
        
       //> Oculta todos os eventos
        $("div .box-item-agenda").hide();
        
        //>Adiciona a imagem do icone de carregar
        $("div .area-exibir-agenda").html("<img class='icone-carregar-agenda' src='http://localhost/fundacaoecarta/wp-content/themes/dazzling-child/imagens/carrega_agenda.gif' >")
        
        //> Mostra o icone
        $("div .area-exibir-agenda").show();
        
        //> Mostra os eventos , baseado com o projeto selecionado
        $('div .box-item-agenda[projeto*="' + nomeProjeto + '"]').show(tempoCarregamento);

        //> Mostra todos os projetos
        if (!nomeProjeto) {
            $("div .box-item-agenda").show(tempoCarregamento);
            $("div .area-exibir-agenda").hide(tempoCarregamento);
            //> Caso não tenha nenhum evento , exibe a mensagem
           if ($('div .box-item-agenda').size() == 0) {
               $(".area-exibir-agenda1").html(msgNenhumEvento).show();
           }
            return;
        }
        
        //> Verifica se existe pelo menos 1 projeto 
        $('div .box-item-agenda').each(function () {
            if ($(this).attr("projeto") == nomeProjeto) {
                cont++;
              }
        });
       
        //> Tira da tela o icone de carregar e encerra
        if (cont >= 1) {
            $("div .area-exibir-agenda").hide(tempoCarregamento);
           
        } else {
        //> Mostra a msg de erro
            $(".area-exibir-agenda1").text(msgNenhumEvento);
            $("div .area-exibir-agenda").hide(tempoCarregamento);
            $(".area-exibir-agenda1").show();
       
        }


    });

//
//      Filtra por cidade ou por mês 
//

    $(".botao-filtro-agenda").click(function () {
        var cidades = $(".cidades-agenda").val();
        var meses = $(".mes-agenda").val();

        //> Limpa o conteúdo da div de notificação
        $("div .area-exibir-agenda").text("");
        $("div .area-exibir-agenda1").text("");
        $("div .mensagem-agenda").text("");
        //>Caixa carregamento
        $("div .area-exibir-agenda").html("<img class='icone-carregar-agenda' src='http://localhost/fundacaoecarta/wp-content/themes/dazzling-child/imagens/carrega_agenda.gif' >")

        //> Oculta todos os eventos e ativa o icone de carregamento
        $("div .area-exibir-agenda").show(tempoCarregamento);
        $("div .box-item-agenda").hide(tempoCarregamento);

        if ((!cidades) && (!meses)) {
            //> Exibe todos os eventos
            $("div .box-item-agenda").show(tempoCarregamento);
            if ($('div .box-item-agenda').size() == 0) {
                 $(".area-exibir-agenda1").html(msgNenhumEvento).show();
                $("div .area-exibir-agenda").hide(tempoCarregamento);
            }
            
        } else if ((cidades) && (meses)) {
            //> Exibe eventos por cidade

            if ($('div .box-item-agenda[cidade="' + cidades + '"][mes="' + meses + '"]').size() == 0) {
                 $(".area-exibir-agenda1").html(msgNenhumEvento).show();
                $("div .area-exibir-agenda").hide(tempoCarregamento);
              
                return;

            } else {
                $('div .box-item-agenda[cidade="' + cidades + '"][mes="' + meses + '"]').show(tempoCarregamento);
            }
            
        } else if (cidades) {
            //> Exibe eventos por cidade
            $('div .box-item-agenda[cidade="' + cidades + '"]').show(tempoCarregamento);
        } else if (meses) {
            $('div .box-item-agenda[mes="' + meses + '"]').show(tempoCarregamento);
        }

        $("div .area-exibir-agenda").hide(tempoCarregamento);        
    
    
     });
//                                                                      
//      Fim do controle de filtros da Agenda    
//                                              
                                
//  *******************************************                              
                               
//                                   
//        Paginação das noticias   
//                                             
    //>Adiciona estilo a pagina ativa
     $(".current").parents("li").css({"color": "#fff", "background": "#606062"});
    
    
    
    
//                                                          
//      Fim Paginação Noticias    
//                                

//  ******************************************* 

});


/*
 Envia os dados do formulário	
 
 idForm       = Id do Formulário
 urlDestino   = Identificação da url de processamento
 idDivRetorno = Identificação da div de retorno do processamento
 */
//idForm, urlDestino, idDivRetorno
function enviaDadosFormAjax(idForm, urlDestino, idTagRetorno) {
    var dados = jQuery('#' + idForm).serialize(); //> Retorna os dados do formulário a ser enviado.

    /* torna opcional informar a url de destino na função, permitindo resgatar do atributo <ACTION> da tag <FORM> */
    if (!urlDestino) {
        urlDestino = jQuery('#' + idForm).attr('action');
    }

    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDestino,
        async: true,
        data: dados,
        success: function (response) {

            /* Necessita verificar o padrão de retorno  do projeto da fundação */
            /** Por enquanto não usado **/
            if (idTagRetorno) {

                jQuery('#' + idTagRetorno).fadeIn(1000); //> Exibe tag <mensagem_retorno> gradativamente  após o tempo <1000> milissegundos 
                jQuery('#' + idTagRetorno).html(response["mensagem"]); //> Exibe mensagem de retorno do ajax a tag <mensagem_retorno>

                if (response["success"] == true) { //> Quando os dados forão efetivados						
                    resetForm(idForm); //> Reseta dos dados do formulário.
                    jQuery('.alerta-rodape').removeClass('alert-danger');
                    jQuery('.alerta-rodape').addClass('alert-success');
                } else {
                    jQuery('.alerta-rodape').removeClass('alert-success');
                    jQuery('.alerta-rodape').addClass('alert-danger');
                }

                jQuery('.alerta-rodape').show();

            }

        }
    });

    return false;
}

/* 
 Limpa todos os dados dos campos do formul�rio especificado.
 */
function resetForm(id) {
    jQuery('#' + id).each(function () {
        this.reset();
    });
}
