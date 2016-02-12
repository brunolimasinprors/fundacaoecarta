<?php

/*
  Responsável por validar,tratar e inserir os dados dos emails informativos
 */

include '../../../wp-load.php';

if (isset($_POST['projetos'])) {
    $aryProjetos = $_POST['projetos'];
} else {
    $msgRetorno = "Selecione sua(s) <strong>área(s) de interesse</strong>.";
}

if (isset($_POST['txtNome'])) {
    $nome = $_POST['txtNome'];
} elseif (!isset($msgRetorno)) {
    $msgRetorno = "O campo <strong>nome</strong> é de preenchimento obrigatório.";
}


if (isset($_POST['txtEmail'])) {

    if (is_email($_POST['txtEmail'])) {
        $email = $_POST['txtEmail'];
    } elseif (!isset($msgRetorno)) {
        $msgRetorno = "O endereço de e-mail informado é <strong>inválido</strong>.";
    }
} elseif (!isset($msgRetorno)) {
    $msgRetorno = "O campo <strong>e-mail</strong> é de preenchimento obrigatório.";
}

if (!empty($msgRetorno)) {

    $retorno = array('success' => 0, 'mensagem' => $msgRetorno);
    echo json_encode($retorno);
} else {
    //remove os espaços antes e depois da string
    $nome = trim($nome);

    /*
     * garante que somente a primeira letra de cada palavra fique maiuscula 
     * Ex: 
     * entrada: BRUNO mendEs lIMa
     * Saída  : Bruno Mendes Lima
     */
    $nome = ucwords(strtolower($nome));

    //remove os espaços antes e depois da string
    $email = trim($email);

    /*
     * garante que toda a string fique minuscula 
     * Ex: 
     * entrada: BRUNOmendEslIMa@Gmail.com
     * Saída  : brunomendeslima@gmail.com
     */
    $email = strtolower($email);

    /* =======================================================================================================	
      '* Verifica na base de dados se o e-mail informado já foi cadastrado e está com a sua situação ativa
      '======================================================================================================== */
    $strSql = "select id, nome, email, dataCadastro, ip from sp_emails_informativo where email = '" . $email . "'";

    $aryDados = $wpdb->get_results($strSql);

    /*
     * Verifica se já existe emails e projetos relacionados
     * Se já existir é necessário efetuar a exclusão
     */

    if ($aryDados) {

        // Recupero o id do email cadastrado na tabela sp_emails_informativo
        $idEmailInformativo = $aryDados[0]->id;

        // Precisamos excluir da tabela sp_projetos_emails_informativo todos os registros que relacionem o email aos projetos
        $wpdb->delete('sp_projetos_emails_informativo', array('idEmailInformativo' => $idEmailInformativo));

        // Efetuamos a exclusão do email localizado antes do novo insert
        $wpdb->delete('sp_emails_informativo', array('id' => $idEmailInformativo));
    }

    // Registro o email para o qual deve ser encaminhado o informativo
    $wpdb->insert(
            'sp_emails_informativo', array(
        'nome' => $nome,
        'email' => $email,
        'ip' => retornaIpCliente()
            )
    );

    //Se a inclusão foi com sucesso, associamos os projetos selecionados
    if (isset($wpdb->insert_id)) {

        $idEmailInformativo = $wpdb->insert_id;

        $erro = false;

        //Para cada projeto selecionado faço a associação com o email
        foreach ($aryProjetos as $idProjeto) {

            $wpdb->insert(
                    'sp_projetos_emails_informativo', array(
                'idProjeto' => $idProjeto,
                'idEmailInformativo' => $idEmailInformativo
                    )
            );

            if (!$wpdb->insert_id) {
                $erro = true;
                break;
            }
        }
        
        if (!$erro) {
            $retorno = array('success' => 1, 'mensagem' => 'E-mail cadastrado com sucesso');
        } else {
            $retorno = array('success' => 0, 'mensagem' => 'Erro ao efetuar o cadastrado do e-mail');
        }
        echo json_encode($retorno);
    }
}
