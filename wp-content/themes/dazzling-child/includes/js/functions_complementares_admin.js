jQuery(document).ready(function ($) {   
    /*
     * Seleciona formato de post <nota>, para o item de menu <agenda> 
     */
    var adicionarAgenda = function () {    
        $("input[name=post_format]").each(function () {
            $(this).attr("checked", false);
        });

        if ($("option:selected", this).text() == "agenda") {
            $("#post-format-aside").attr("checked", true).trigger("change");
        } else {
            $("#post-format-0").attr("checked", true).trigger("change");
        }
    }
        
    $("#acf-field-tag_item_menu_post").each(adicionarAgenda);
    $("#acf-field-tag_item_menu_post").change(adicionarAgenda);

});

