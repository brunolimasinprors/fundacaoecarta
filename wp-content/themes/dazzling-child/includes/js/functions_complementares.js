jQuery(document).ready(function ($) {
    /*
     Carrosel chamadas principais site
     */
    $('#chamadas-principais').carousel({
        interval: 9000
    });



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

    totalItens = 4;
    $('#area-slide-carousel-agenda-capa .item').each(function () {

        //if ($("#carousel-example-vertical .item").length > 4){

        /*
         var next = $(this).next();			
         
         
         
         if (!next.length) {
         next = $(this).siblings(':first');
         }
         
         next.children(':first-child').clone().appendTo($(this));	  
         for (var i=0;i<2;i++) {
         next=next.next();
         if (!next.length) {
         next = $(this).siblings(':first');
         }
         
         next.children(':first-child').clone().appendTo($(this));
         }
         */

        //}



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
        //limite


        for (var i = 0; i < limite; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }


        /*
         if (next.next().length >0) {
         next.next().children(':first-child').clone().appendTo($(this));
         }else {
         $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
         }
         */



    });

    $(".todas").click(function () {
        //$(this).prop("checked", false);
        $(".caixaCheckbox").each(function () {

            if ($(".todas").prop("checked"))
                $(this).prop("checked", true);
            else
                $(this).prop("checked", false);

        });
    });

    $("#btCadastrar").click(function () {
        var teste = false;
        $(".campo-preenchimento-rodape").text("");


        $('.caixaCheckbox').each(function () {
            if ($(this).prop("checked") == true) {
                teste = true;
                return;
            }

        });
        //return teste;

        if (!teste) {
            $(".campo-preenchimento-rodape").html("Selecione sua(s) <strong>área(s) de interesse</strong>. ");
            $('.alerta-rodape').show();
            return;
        }

        if ($("#txtNome").val() == "") {
            $(".campo-preenchimento-rodape").html("O campo <strong>nome</strong> é de preenchimento obrigatório. ");
            $('.alerta-rodape').show();
            return;

        } else if ($("#txtEmail").val() == "") {
            $(".campo-preenchimento-rodape").html("O campo <strong>e-mail</strong> é de preenchimento obrigatório. ");
            $('.alerta-rodape').show();

        } else if ($("#txtEmail").val() != "") {
            var email = $("#txtEmail").val();
            if (validarEmail(email)) {
                $('.alerta-rodape').hide();
                return;
            } else
                $(".campo-preenchimento-rodape").html("O endereço de e-mail informado é <strong>inválido</strong>.");
            $('.alerta-rodape').show();
            return;
        }

    });
    $(".botao-fecha-alerta").click(function () {
        $('.alerta-rodape').hide();

    });

    function validarEmail(emailAddress) {
        var verifica = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return verifica.test(emailAddress);
    }

    $('#carousel-galeria-imagens').carousel({
        interval: false
    });

});


/*
 Envia os dados do formulário	
 
 idForm       = Id do Formulário
 urlDestino   = Identificação da url de processamento
 idDivRetorno = Identificação da div de retorno do processamento
 */
//idForm, urlDestino, idDivRetorno
function enviaDadosFormAjax(idForm, urlDestino, idDivRetorno) {
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
               alert(response); 
            /* Necessita verificar o padrão de retorno  do projeto da fundação */
            /** Por enquanto não usado **/
            if (idDivRetorno) {
                jQuery('#' + idDivRetorno).fadeIn(1000); //> Exibe div <mensagem_retorno> gradativamente  após o tempo <1000> milissegundos 
                jQuery('#' + idDivRetorno).html(response["mensagem"]); //> Exibe mensagem de retorno do ajax a div <mensagem_retorno> 

                //> Adiciona a classe da mensagem corrrespondente
                /*if (response["success"] == 1) {
                    jQuery('#' + idDivRetorno).removeClass("mensagem_erro");
                    jQuery('#' + idDivRetorno).addClass("mensagem_sucesso");
                } else {
                    jQuery('#' + idDivRetorno).removeClass("mensagem_sucesso");
                    jQuery('#' + idDivRetorno).addClass("mensagem_erro");
                }
                //response["success"]
*/

                if (response["success"] == true) { //> Quando os dados forão efetivados						
                    resetForm(idForm); //> Reseta dos dados do formulário.
                }
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