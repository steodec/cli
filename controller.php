#!/usr/bin/php -q
<?php
require_once 'cmd.php';
define('APP_ROOT_FOLDER', dirname(__DIR__));

$controllerName = getName();
if (!empty($controllerName)):
    $controllerName = trim(ucfirst($controllerName)) . 'Controller';
    $data           = "<?php\n\n namespace App\\controllers;\n\n use SteodecControllers\AbstractControllers; \n\n class {$controllerName} extends AbstractControllers {\n\n }";
    $file           = APP_ROOT_FOLDER . '/src/controllers/' . $controllerName . '.php';
    if (!file_exists($file)):
        touch($file);
        file_put_contents($file, $data);
        echo "\nLe fichier a été généré";
    endif;
endif;