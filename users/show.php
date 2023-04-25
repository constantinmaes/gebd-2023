<?php

$q = $db->prepare('SELECT * FROM users WHERE id=:id');
$q->bindParam(':id', $parameter);
$q->execute();

$result = $q->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Affichage des données
    // $result['id'], $result['email'], $result['firstName'], etc.
    $html = '';
    $html .= '<p>ID: '.$result['id'].'</p>';
    $html .= '<p>Email: '.$result['email'].'</p>';
    $html .= '<p>First name: '.$result['firstName'].'</p>';
    $html .= '<p>Last name: '.$result['lastName'].'</p>';

    echo $html;

} else {
    echo 'Pas d\'utilisateur avec cet id';
}