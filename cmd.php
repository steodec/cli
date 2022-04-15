<?php

/**
 * @return string
 */
function getName(): string {
    if (!defined("STDIN")) {
        define("STDIN", fopen('php://stdin', 'r'));
    }
    echo "=========== Steodec CLI =========== \n";
    if (isset($_SERVER['argv'][1])):
        echo "Tu as choice le nom du fichier: {$_SERVER['argv'][1]} \n";
        $controllerName = $_SERVER['argv'][1];
    else:
        echo "Merci de choisir le nom du fichier: \n";
        $controllerName = fread(STDIN, 255);
    endif;
    return $controllerName;
}
