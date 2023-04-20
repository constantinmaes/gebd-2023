<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  </head>
  <body>

<?php

try {
    $db = new PDO('mysql:dbname=gebd;host=127.0.0.1', 'root', 'notSecureChangeMe');
} catch (Exception $e) {
    echo $e;
}

$urlArray = explode('/', $_SERVER['REQUEST_URI']);

$cleanedArray = array_slice($urlArray, 2);

// url se termine par index.php ou index.php/
if (count($cleanedArray) === 0 || $cleanedArray[0] === "") {
    echo 'Homepage';
    return;
}

// Récupération de la ressource (type de données)
$resource = $cleanedArray[0];

// users/1 => affiche 1 utilisateur
// users/1/edit => formulaire d'édition de l'utilisateur avec l'id 1

if ($cleanedArray[1] === NULL || $cleanedArray[1] === "") {
    require_once('./'.$resource.'/list.php');
    return;
}

$parameter = $cleanedArray[1];

if ($parameter === 'create') {
    echo 'Formulaire de création de la ressource '.$resource;
    require_once('./'.$resource.'/create.php');
    return;
}

if (is_numeric($parameter)) {
    if ($cleanedArray[2] === NULL || $cleanedArray[2] === "") {
        echo 'Affichage de la ressource '.$resource.' avec l\'id'.$parameter;
        require_once('./'.$resource.'/show.php');
        return;
    }
    if ($cleanedArray[2] === 'edit') {
        echo 'Formulaire d\'édition de la ressource '.$resource.' avec l\'id '.$parameter;
        require_once('./'.$resource.'/edit.php');
        return;
    }

    if ($cleanedArray[2] === 'delete') {
        echo 'Confirmation de suppression de la ressource '.$resource.' avec l\'id '.$parameter;
        require_once('./'.$resource.'/delete.php');
        return;
    }
}

echo 'URL invalide';

?>

  </body>
</html>