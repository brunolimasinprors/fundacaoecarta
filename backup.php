<?php

//Localização da classe backup no projeto
include_once './wp-content/themes/dazzling-child/includes/classes/backup.class.php';

//Acesso as informações do config do wordpress
include_once './wp-config.php';

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

