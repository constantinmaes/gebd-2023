<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Requête dans la base de données sur la base l'id ($parameter)
    $q = $db->prepare('SELECT * FROM users WHERE id=:id');
    $q->bindParam(':id', $parameter);
    $q->execute();
    $result = $q->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Affiche le formulaire précomplété
        $html = '<form method="POST">';
        $html .= '<input type="text" value="'.$result["firstName"].'" name="firstName" placeholder="First name"  />';
        $html .= '<input type="text" value="'.$result["lastName"].'"name="lastName" placeholder="Last name" />';
        $html .= '<input type="email" value="'.$result["email"].'"name="email" placeholder="Email" />';
        $html .= '<input type="password" value="'.$result["password"].'" name="password" placeholder="Password" />';
        $html .= '<input type="submit" name="bSubmit" />';
        $html .= '</form>';
        echo $html;
    } else {
        echo 'Pas d\'utilisateur avec cet id';
    }


    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enregistre les données du formulaire
    // dans la base de données
    $firstName = strip_tags($_POST['firstName']);
    $lastName = strip_tags($_POST['lastName']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);
    
    $q = $db->prepare('UPDATE users SET firstName=:firstName, lastName=:lastName, email=:email, password=:password WHERE id=:id;');
    $q->bindParam(':firstName', $firstName);
    $q->bindParam(':lastName', $lastName);
    $q->bindParam(':email', $email);
    $q->bindParam(':password', $password);
    $q->bindParam(':id', $parameter);
    $q->execute();

    header('Location: /index.php/users/');
}