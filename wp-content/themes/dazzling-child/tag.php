 <?php
                    $tag = get_term_by('id', get_query_var('tag_id'), 'post_tag');                    
                    if ($tag) {
                        /* =================================================================================================================	
                          '* Exibe conteúdo o layout da area/tag acessada
                          '================================================================================================================= */
                        if ($tag->slug == "agenda") {
                            get_template_part('agenda', get_post_format());
                        }elseif($tag->slug == "inscricao") {
                            get_template_part('parcerias', get_post_format());
                        
                        }else {
                            get_template_part('content-padrao', get_post_format());
                        }
                    
                    }
                    ?>