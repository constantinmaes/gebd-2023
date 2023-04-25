<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Requête dans la base de données sur la base l'id ($parameter)
    $q = $db->prepare('SELECT * FROM users WHERE id=:id');
    $q->bindParam(':id', $parameter);
    $q->execute();
    $result = $q->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Affiche le formulaire de confirmation de suppression
        $html = '<p>Voulez-vous vraiment supprimer l\'utilisateur avec l\'id '.$parameter.'</p>';
        $html .= '<form method="POST">';
        $html .= '<input type="submit" name="bSubmit" />';
        $html .= '</form>';
        echo $html;
    } else {
        echo 'Pas d\'utilisateur avec cet id';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Supprime la ligne dans la table users
    // dans la base de données
   
    $q = $db->prepare('DELETE FROM users WHERE id=:id');
    $q->bindParam(':id', $parameter);
    $q->execute();

    header('Location: /index.php/users/');
}