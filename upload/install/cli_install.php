<?php

//
// Command line tool for installing opencart
// Author: Vineet Naik <vineet.naik@kodeplay.com> <naikvin@gmail.com>
//
// (Currently tested on linux only)
//
// Usage:
//
//   cd install
//   php cli_install.php install --db_host localhost \
//                               --db_user root \
//                               --db_password pass \
//                               --db_name opencart \
//                               --username admin \
//                               --password admin \
//                               --email youremail@example.com \
//                               --agree_tnc yes \
//                               --http_server http://localhost/opencart
//

ini_set('display_errors', 1);
error_reporting(E_ALL);

// DIR
define('DIR_APPLICATION', str_replace('\'', '/', realpath(dirname(__FILE__))) . '/');
define('DIR_SYSTEM', str_replace('\'', '/', realpath(dirname(__FILE__) . '/../')) . '/system/');
define('DIR_OPENCART', str_replace('\'', '/', realpath(DIR_APPLICATION . '../')) . '/');
define('DIR_DATABASE', DIR_SYSTEM . 'database/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');

// Startup
require_once(DIR_SYSTEM . 'startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);


function handleError($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler('handleError');


function usage() {
    echo "Usage:\n";
    echo "======\n";
    echo "\n";
    $options = implode(" ", array('--db_host', 'localhost',
                                  '--db_user', 'root',
                                  '--db_password', 'pass',
                                  '--db_name', 'opencart',
                                  '--username', 'admin',
                                  '--password', 'admin',
                                  '--email', 'youremail@example.com',
                                  '--agree_tnc', 'yes',
                                  '--http_server', 'http://localhost/opencart'));
    echo 'php cli_install.php install ' . $options . "\n\n";
}


function get_options($argv) {
    $defaults = array(
        'db_host' => 'localhost',
        'db_name' => 'opencart',
        'db_prefix' => '',
        'username' => 'admin',
        'agree_tnc' => 'no',
    );

    $options = array();
    $total = count($argv);
    for ($i=0; $i < $total; $i=$i+2) {
        $is_flag = preg_match('/^--(.*)$/', $argv[$i], $match);
        if (!$is_flag) {
            throw new Exception($argv[$i] . ' found in command line args instead of a valid option name starting with \'--\'');
        }
        $options[$match[1]] = $argv[$i+1];
    }
    return array_merge($defaults, $options);
}


function valid($options) {
    $required = array(
        'db_host',
        'db_user',
        'db_password',
        'db_name',
        'db_prefix',
        'username',
        'password',
        'email',
        'agree_tnc',
        'http_server',
    );
    $missing = array();
    foreach ($required as $r) {
        if (!array_key_exists($r, $options)) {
            $missing[] = $r;
        }
    }
    if ($options['agree_tnc'] !== 'yes') {
        $missing[] = 'agree_tnc (should be yes)';
    }
    $valid = count($missing) === 0 && $options['agree_tnc'] === 'yes';
    return array($valid, $missing);
}


function install($options) {
    $check = check_requirements();
    if ($check[0]) {
        setup_mysql($options);
        write_config_files($options);
        dir_permissions();
    } else {
        echo '失敗! 安裝中檢查到錯誤: ' . $check[1] . "\n\n";
        exit(1);
    }
}


function check_requirements() {
    $error = null;
    if (phpversion() < '5.0') {
		$error = '您需要使用PHP5 或 以上的版本才能正常使用OpenCart!';
    }

    if (!ini_get('file_uploads')) {
		$error = '必須開啟 file_uploads 功能!';
    }

    if (ini_get('session.auto_start')) {
		$error = '請關閉session.auto_start 否則OpenCart 無法正常工作!';
    }

    if (!extension_loaded('mysql')) {
		$error = '必須載入 MySQL extension !';
    }

    if (!extension_loaded('gd')) {
		$error = '必須載入 GD extension !';
    }

    if (!extension_loaded('curl')) {
		$error = '必須載入 CURL extension !';
    }

    if (!function_exists('mcrypt_encrypt')) {
		$error = '必須載入 mCrypt extension !';
    }

    if (!extension_loaded('zlib')) {
		$error = '必須載入 ZLIB extension !';
    }

    if (!is_writable(DIR_OPENCART . 'config.php')) {
		$error = '警告: config.php 檔案必須可讀寫才能安裝!';
    }

    if (!is_writable(DIR_OPENCART . 'admin/config.php')) {
		$error = '警告: admin/config.php 檔案必須可讀寫才能安裝!';
    }

    if (!is_writable(DIR_SYSTEM . 'cache')) {
		$error = 'Cache 目錄必須設定成可讀寫才能安裝!';
    }

    if (!is_writable(DIR_SYSTEM . 'logs')) {
		$error = 'Logs 目錄必須設定成可讀寫才能安裝!';
    }

    if (!is_writable(DIR_OPENCART . 'image')) {
		$error = 'Image 目錄必須設定成可讀寫才能安裝!';
    }

    if (!is_writable(DIR_OPENCART . 'image/cache')) {
		$error = 'Image/cache 目錄必須設定成可讀寫才能安裝!';
    }

    if (!is_writable(DIR_OPENCART . 'image/data')) {
		$error = 'Image/data 目錄必須設定成可讀寫才能安裝!';
    }

    if (!is_writable(DIR_OPENCART . 'download')) {
		$error = 'Download 目錄必須設定成可讀寫才能安裝!';
    }

    return array($error === null, $error);
}


function setup_mysql($dbdata) {
    global $loader, $registry;
    $loader->model('install');
    $model = $registry->get('model_install');
    $model->mysql($dbdata);
}


function write_config_files($options) {
    $output  = '<?php' . "\n";
    $output .= '// HTTP' . "\n";
    $output .= 'define(\'HTTP_SERVER\', \'' . $options['http_server'] . '\');' . "\n";
    $output .= 'define(\'HTTP_IMAGE\', \'' . $options['http_server'] . 'image/\');' . "\n";
    $output .= 'define(\'HTTP_ADMIN\', \'' . $options['http_server'] . 'admin/\');' . "\n\n";

    $output .= '// HTTPS' . "\n";
    $output .= 'define(\'HTTPS_SERVER\', \'' . $options['http_server'] . '\');' . "\n";
    $output .= 'define(\'HTTPS_IMAGE\', \'' . $options['http_server'] . 'image/\');' . "\n\n";

    $output .= '// DIR' . "\n";
    $output .= 'define(\'DIR_APPLICATION\', \'' . DIR_OPENCART . 'catalog/\');' . "\n";
    $output .= 'define(\'DIR_SYSTEM\', \'' . DIR_OPENCART. 'system/\');' . "\n";
    $output .= 'define(\'DIR_DATABASE\', \'' . DIR_OPENCART . 'system/database/\');' . "\n";
    $output .= 'define(\'DIR_LANGUAGE\', \'' . DIR_OPENCART . 'catalog/language/\');' . "\n";
    $output .= 'define(\'DIR_TEMPLATE\', \'' . DIR_OPENCART . 'catalog/view/theme/\');' . "\n";
    $output .= 'define(\'DIR_CONFIG\', \'' . DIR_OPENCART . 'system/config/\');' . "\n";
    $output .= 'define(\'DIR_IMAGE\', \'' . DIR_OPENCART . 'image/\');' . "\n";
    $output .= 'define(\'DIR_CACHE\', \'' . DIR_OPENCART . 'system/cache/\');' . "\n";
    $output .= 'define(\'DIR_DOWNLOAD\', \'' . DIR_OPENCART . 'download/\');' . "\n";
    $output .= 'define(\'DIR_LOGS\', \'' . DIR_OPENCART . 'system/logs/\');' . "\n\n";

    $output .= '// DB' . "\n";
    $output .= 'define(\'DB_DRIVER\', \'mysql\');' . "\n";
    $output .= 'define(\'DB_HOSTNAME\', \'' . addslashes($options['db_host']) . '\');' . "\n";
    $output .= 'define(\'DB_USERNAME\', \'' . addslashes($options['db_user']) . '\');' . "\n";
    $output .= 'define(\'DB_PASSWORD\', \'' . addslashes($options['db_password']) . '\');' . "\n";
    $output .= 'define(\'DB_DATABASE\', \'' . addslashes($options['db_name']) . '\');' . "\n";
    $output .= 'define(\'DB_PREFIX\', \'' . addslashes($options['db_prefix']) . '\');' . "\n";
    $output .= '?>';

    $file = fopen(DIR_OPENCART . 'config.php', 'w');

    fwrite($file, $output);

    fclose($file);

    $output  = '<?php' . "\n";
    $output .= '// HTTP' . "\n";
    $output .= 'define(\'HTTP_SERVER\', \'' . $options['http_server'] . 'admin/\');' . "\n";
    $output .= 'define(\'HTTP_CATALOG\', \'' . $options['http_server'] . '\');' . "\n";
    $output .= 'define(\'HTTP_IMAGE\', \'' . $options['http_server'] . 'image/\');' . "\n\n";

    $output .= '// HTTPS' . "\n";
    $output .= 'define(\'HTTPS_SERVER\', \'' . $options['http_server'] . 'admin/\');' . "\n";
    $output .= 'define(\'HTTPS_CATALOG\', \'' . $options['http_server'] . '\');' . "\n";
    $output .= 'define(\'HTTPS_IMAGE\', \'' . $options['http_server'] . 'image/\');' . "\n\n";

    $output .= '// DIR' . "\n";
    $output .= 'define(\'DIR_APPLICATION\', \'' . DIR_OPENCART . 'admin/\');' . "\n";
    $output .= 'define(\'DIR_SYSTEM\', \'' . DIR_OPENCART . 'system/\');' . "\n";
    $output .= 'define(\'DIR_DATABASE\', \'' . DIR_OPENCART . 'system/database/\');' . "\n";
    $output .= 'define(\'DIR_LANGUAGE\', \'' . DIR_OPENCART . 'admin/language/\');' . "\n";
    $output .= 'define(\'DIR_TEMPLATE\', \'' . DIR_OPENCART . 'admin/view/template/\');' . "\n";
    $output .= 'define(\'DIR_CONFIG\', \'' . DIR_OPENCART . 'system/config/\');' . "\n";
    $output .= 'define(\'DIR_IMAGE\', \'' . DIR_OPENCART . 'image/\');' . "\n";
    $output .= 'define(\'DIR_CACHE\', \'' . DIR_OPENCART . 'system/cache/\');' . "\n";
    $output .= 'define(\'DIR_DOWNLOAD\', \'' . DIR_OPENCART . 'download/\');' . "\n";
    $output .= 'define(\'DIR_LOGS\', \'' . DIR_OPENCART . 'system/logs/\');' . "\n";
    $output .= 'define(\'DIR_CATALOG\', \'' . DIR_OPENCART . 'catalog/\');' . "\n\n";
	$output .= 'define(\'DNONO_SUPPORT\', \'中文支援(Dnono.com)\');' . "\n";
	$output .= 'define(\'DNONO\', \'中文版本提供\');' . "\n\n";
	
    $output .= '// DB' . "\n";
    $output .= 'define(\'DB_DRIVER\', \'mysql\');' . "\n";
    $output .= 'define(\'DB_HOSTNAME\', \'' . addslashes($options['db_host']) . '\');' . "\n";
    $output .= 'define(\'DB_USERNAME\', \'' . addslashes($options['db_user']) . '\');' . "\n";
    $output .= 'define(\'DB_PASSWORD\', \'' . addslashes($options['db_password']) . '\');' . "\n";
    $output .= 'define(\'DB_DATABASE\', \'' . addslashes($options['db_name']) . '\');' . "\n";
    $output .= 'define(\'DB_PREFIX\', \'' . addslashes($options['db_prefix']) . '\');' . "\n";
    $output .= '?>';

    $file = fopen(DIR_OPENCART . 'admin/config.php', 'w');

    fwrite($file, $output);

    fclose($file);
}


function dir_permissions() {
    $dirs = array(
        DIR_OPENCART . 'image/',
        DIR_OPENCART . 'download/',
        DIR_SYSTEM . 'cache/',
        DIR_SYSTEM . 'logs/',
    );
    exec('chmod o+w -R ' . implode(' ', $dirs));
}


$argv = $_SERVER['argv'];
$script = array_shift($argv);
$subcommand = array_shift($argv);


switch ($subcommand) {

case "install":
    try {
        $options = get_options($argv);
        define('HTTP_OPENCART', $options['http_server']);
        $valid = valid($options);
        if (!$valid[0]) {
            echo "安裝失敗! 以下資料錯誤或不存在: ";
            echo implode(', ',  $valid[1]) . "\n\n";
            exit(1);
        }
        install($options);
        echo "安裝成功! Opencart 已成功安裝至您的主機\n";
        echo "商店: " . $options['http_server'] . "\n";
        echo "商店管理後台: " . $options['http_server'] . "admin/\n\n";
    } catch (ErrorException $e) {
        echo '錯誤!: ' . $e->getMessage() . "\n";
        exit(1);
    }
    break;
case "usage":
default:
    echo usage();
}
?>