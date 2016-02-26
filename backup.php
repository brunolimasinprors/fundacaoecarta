<?php

class Backup {

    private $dbhost;
    private $dbuser;
    private $dbpwd;
    private $dbname;
    private $diretorio;
    private $diasmanterbackup;
    private $mesesmanterbackupmensal;
    private $arquivolog;

    function __construct() {
        //Acesso as informações do config do wordpress
        include_once './wp-config.php';
        
        //Garantir que o texto fique legível
        header('Content-Type: text/html; charset=utf-8');

        //Garante que o fuso-horário seja sempre o do Brasil, independente do que estiver no php.ini
        date_default_timezone_set('America/Sao_Paulo');

        $this->diasmanterbackup = '7';
        $this->mesesmanterbackupmensal = '12';
    }

    function __destruct() {
        fclose($this->arquivolog);
    }

    public function fechaArquivoLog() {
        // Fecha o arquivo de log
        fclose($this->arquivolog);
    }

    public function setDbHost($param_dbhost) {
        $this->dbhost = $param_dbhost;
    }

    public function getDbHost() {
        return $this->dbhost;
    }

    public function setDbUser($param_dbuser) {
        $this->dbuser = $param_dbuser;
    }

    public function getDbUser() {
        return $this->dbuser;
    }

    public function setDbPwd($param_dbpwd) {
        $this->dbpwd = $param_dbpwd;
    }

    public function getDbPwd() {
        return $this->dbpwd;
    }

    public function setDbName($param_dbname) {
        $this->dbname = $param_dbname;
    }

    public function getDbName() {
        return $this->dbname;
    }

    public function setDiretorio($param_dir) {
        $this->diretorio = $param_dir;
    }

    public function getDiretorio() {
        return $this->diretorio;
    }

    public function setDiasManterBackup($param_dias) {
        $this->diasmanterbackup = $param_dias;
    }

    public function getDiasManterBackup() {
        return $this->diasmanterbackup;
    }

    public function setMesesManterBackupMensal($param_meses) {
        $this->mesesmanterbackupmensal = $param_meses;
    }

    public function getMesesManterBackupMensal() {
        return $this->mesesmanterbackupmensal;
    }

    public function efetuarBackup() {
        $this->gravaLog("------------------------------------------------------------------------" . PHP_EOL);
        $this->gravaLog("Iniciando o processo de backup - " . date("Y-m-d_H-i-s") . PHP_EOL);

        if (!empty($this->diretorio) && is_dir($this->diretorio)) {

            $dumpfile = $this->diretorio . $this->dbname . "_" . date("Y-m-d_H-i-s") . ".sql";

            $comando = "mysqldump --opt -R --host=$this->dbhost --user=$this->dbuser --password=$this->dbpwd $this->dbname > $dumpfile";

            $this->gravaLog("Gravando arquivo de backup no caminho: " . $dumpfile . " - " . date("Y-m-d_H-i-s") . PHP_EOL);

            $retorno = null;
            passthru($comando, $retorno);

            if ($retorno == 0) {
                // mensagem de retorno sucesso "-- Dump completed on ..." 
                passthru("tail -1 $dumpfile");
                $this->gravaLog("Backup gerado com sucesso! " . date("Y-m-d_H-i-s") . PHP_EOL);
            }
        }
        $this->gravaLog("------------------------------------------------------------------------" . PHP_EOL);
    }

    public function manterBackups() {
        $this->gravaLog("------------------------------------------------------------------------" . PHP_EOL);
        $this->gravaLog("Iniciando o processo de <exclusão> dos arquivos com mais de " . $this->diasmanterbackup . " dia(s) e que não pertence ao backup mensal no período de " . $this->mesesmanterbackupmensal . " mes(es)" . PHP_EOL);

        //Data limite para permanencia do arquivo    
        $datalimite = strtotime('-' . $this->diasmanterbackup . ' day', time());

        $count = 0;

        //Percorre todos os arquivos do diretório
        foreach (glob($this->diretorio . '*.sql') as $file) {

            //Data de modificação arquivo
            $datamodificacao = filemtime($file);

            //Verifica se o arquivo já pode ser excluído do diretório
            if ($this->validar($datalimite, $datamodificacao)) {

                //Excluir arquivos
                $this->excluirArquivo($file);
                $this->gravaLog("Arquivo " . $file . " excluído com sucesso" . PHP_EOL);
                $count++;
            }
        }

        if ($count == 0) {
            $this->gravaLog("Não há arquivos que atendam as regras para exclusão." . PHP_EOL);
        } else {
            $this->gravaLog("Total de arquivos excluídos: " . $count . PHP_EOL);
        }

        $this->gravaLog("------------------------------------------------------------------------" . PHP_EOL);
    }

    public function validar($p_datalimite, $p_datamodificacao) {

        $retorno = false;

        //verifico se a modificação do arquivo já ultrapassou o limite especificado
        if (($p_datalimite > $p_datamodificacao)) {

            //retorno o dia da data de modificação
            $diaDoMes = date('d', $p_datamodificacao);

            //retorno o mês da data de modificação
            $mes = date('m', $p_datamodificacao);

            //retorno o último dia do mês da data de modificação
            $ultimoDiaMes = $this->retornaUltimoDiaMes($mes);

            //verifico quantos meses existem de diferença entre o limite de permanencia e a data de modificação
            $diferenca = $this->date_diff($p_datalimite, $p_datamodificacao);
            $mesesDiferenca = $diferenca->m;

            /*
             *  determino a flag como true se não for o último dia do mês, ou já passou do limite de meses (default 12 meses)
             */

            if (($ultimoDiaMes !== $diaDoMes) || ($mesesDiferenca > $this->mesesmanterbackupmensal)) {

                $retorno = true;
            }
        }

        return $retorno;
    }

    public function excluirArquivo($p_caminhoarquivo) {

        if (!empty($p_caminhoarquivo)) {

            if (file_exists($p_caminhoarquivo)) {

                unlink($p_caminhoarquivo);
            }
        }
    }

    public function retornaUltimoDiaMes($p_mes) {
        $ultimo_dia = "";

        if (!empty($p_mes)) {
            $ano = date("Y"); // Ano atual
            $ultimo_dia = date("t", mktime(0, 0, 0, $p_mes, '01', $ano));
        }

        return $ultimo_dia;
    }

    public function date_diff(
    $p_datainicial, $p_datafinal) {

        $retorno = null;

        if (!empty($p_datainicial) && !empty($p_datafinal)) {
            $datainicial = date("Y-m-d H:i:s", $p_datainicial);
            $datafinal = date("Y-m-d H:i:s", $p_datafinal);
            $diferenca = new DateTime($datainicial);
            $retorno = $diferenca->diff(new DateTime($datafinal));
        }

        return $retorno;
    }

    public function gravaLog($p_msg) {

        $this->arquivolog = fopen($this->diretorio . "backupmysql.log ", "a");
        $escreve = fwrite($this->arquivolog, $p_msg);
    }

}

$backup = new Backup();

/* Informações do servidor mysql */
$backup->setDbHost(DB_HOST);
$backup->setDbUser(DB_USER);
$backup->setDbPwd(DB_PASSWORD);
$backup->setDbName(DB_NAME);

/* Diretório onde o backup será salvo */
$backup->setDiretorio(DB_PATH_BACKUP);

/* Configurar a permanencia do backup no diretório */
$backup->setDiasManterBackup("7");
$backup->setMesesManterBackupMensal("12");

/* Gera o arquivo de backup */
$backup->efetuarBackup();

/* Mantém somente os backups atualizados dentro das configurações */
$backup->manterBackups();

