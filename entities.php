#!/usr/bin/php -q
<?php
require_once 'cmd.php';

define('APP_ROOT_FOLDER', dirname(__DIR__));

$controllerName = getName();
if (!empty($controllerName)):
    echo "Nom de la table en base: \n";
    $table_name = trim(fread(STDIN, 255));

    $not_finish = TRUE;
    $champs     = [];
    while ($not_finish):
        $champ = new stdClass();
        echo "Enregistrer un nouveaux champ (laisser vide pour annuler): \n";
        $name = trim(fread(STDIN, 255));
        echo "\n";
        if (empty($name)):
            $not_finish = FALSE;
            continue;
        endif;
        echo "Enregistrer le type: \n";
        $type = trim(fread(STDIN, 255));
        echo "\n";
        $champ->name = $name;
        $champ->type = $type;
        $champs[]    = $champ;
    endwhile;

    $controllerName = ucfirst($controllerName) . 'Entity';
    $data           = "<?php\n\n namespace App\\entity;\n\n use Steodec\ORM\AbstractEntity; \n\n class {$controllerName} extends AbstractEntity {\n\n const TABLE_NAME=\"{$table_name}\";";
    foreach ($champs as $champ):
        $data .= "\n public {$champ->type} \${$champ->name};";
    endforeach;
    $data = $data . " \n public function __construct(){parent::__construct();}\n\n}";
    $file = './src/entities/' . $controllerName . '.php';
    if (!file_exists($file)):
        touch($file);
        file_put_contents($file, $data);
        echo "\nLe fichier a été généré";
    endif;
endif;