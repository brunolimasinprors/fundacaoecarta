<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'fundacaoecarta');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'XF$wyFZ}oygH0X{CK9{/-RMM.;{X_hbM|iZ~Qe$t1U=aoG^6VyLFrKQ60AY?2 ,R');
define('SECURE_AUTH_KEY',  'L`o:XoI01YFCRn-gOLjQ+>?(LR5Ka+-G]yA(<o4Y~=${^[+a5$b;5QtvnK``P+qF');
define('LOGGED_IN_KEY',    '@ %kuEYmPcV|aT]rZW+<]:yTT-IqWGt`Aaf{UBR[DD@gR-.d+JnxLjr1U22Nei+?');
define('NONCE_KEY',        'oqjMM/%pEN{VeM>s|nYE^3Kh7oWEDYfzOoo+jIZ|nEA&v@nNw|*F:DD?E=yP;-Fq');
define('AUTH_SALT',        'jya|L4Mu-<>,QlMzUwD`z%1w@%7-|/im.),AdB<5K}:PmfAWARA-m+q;0IMF$ZS4');
define('SECURE_AUTH_SALT', '[b ,iv5;*>jYA.VIb+5x@C`U!O$>*.|N5|`Gf*rdEK3(&kla-xh^3oM,^y+T9qG,');
define('LOGGED_IN_SALT',   ')%Im-qoeLEH@ d||.></K$q+D<c6j-$TUM!Ec-fY;bo1L?N~1fFo|ZQHM||tDnA1');
define('NONCE_SALT',       '&A{coAGZ,o;f<:[Gk`Uq,5ab[4;Y}WolL22:9BBFZ_gf)C|]F+9$u]MKZ5Tg7O4E');

/**#@-*/

/**** Define que o método de atualização será direto pela internet ****/
define('FS_METHOD','direct');

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', true);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
