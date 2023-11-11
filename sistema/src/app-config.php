<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Constantes Gerais da Aplicação
define('SITE_NAME', 'OdontoVida');
define('SITE_URL', 'http://cursophp.local/sistema');
define('SITE_SLOGAN', 'Especialistas em saúde bucal');
define('FUNCTIONS_DIR', __DIR__ . "/functions");
define('COMPONENTS_DIR', __DIR__ . "/components");
define('ROOT_DIR', __DIR__ . "/..");
define('CSS_URL', SITE_URL . '/assets/css');
define('JS_URL', SITE_URL . '/assets/js');
define('IMG_URL', SITE_URL . '/assets/img');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'odontovida');

// Importação automática dos arquivos de funções
$functions_files = glob(FUNCTIONS_DIR . '/*.php') ?: [];
foreach ($functions_files as $filename) {
    require_once $filename;
}