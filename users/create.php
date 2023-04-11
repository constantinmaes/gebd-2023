<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Affiche le formulaire vide
    $html = '<form method="POST">';
    $html .= '<input type="text" name="firstName" placeholder="First name" />';
    $html .= '<input type="text" name="lastName" placeholder="Last name" />';
    $html .= '<input type="email" name="email" placeholder="Email" />';
    $html .= '<input type="password" name="password" placeholder="Password" />';
    $html .= '<input type="submit" name="bSubmit" />';
    $html .= '</form>';
    echo $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enregistre les données du formulaire
    // dans la base de données
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    
    $q = $db->prepare('INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password);');
    $q->bindParam(':firstName', $firstName);
    $q->bindParam(':lastName', $lastName);
    $q->bindParam(':email', $email);
    $q->bindParam(':password', $password);
    $q->execute();
}