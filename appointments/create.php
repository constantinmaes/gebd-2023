<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $q = $db->prepare('SELECT * FROM users');
    $q->execute();
    $users = $q->fetchAll(PDO::FETCH_ASSOC);

    // Affiche le formulaire vide
    $html = '<form method="POST">';
    $html .= '<input type="text" name="title" placeholder="Title" />';
    $html .= '<select multiple name="participants[]">';

    // Boucler sur $users pour rajouter des <option></option>
    foreach ($users as $user) {
        $html .= '<option value="'.$user['id'].'">';
        $html .= $user['email'];
        $html .= '</option>';
    }


    $html .= '</select>';
    $html .= '<input type="submit" name="bSubmit" />';
    $html .= '</form>';
    echo $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Enregistre les données du formulaire
    // dans la base de données
    $title = strip_tags($_POST['title']);
    $participantsIds = $_POST['participants']; // [1, 4, 6]
    
    $q = $db->prepare('INSERT INTO appointments (title) VALUES (:title);');
    $q->bindParam(':title', $title);
    $q->execute();

    $appointmentQ = $db->prepare('SELECT id FROM appointments ORDER BY id DESC LIMIT 1;');
    $appointmentQ->execute();
    $lastAppointment = $appointmentQ->fetch(PDO::FETCH_ASSOC);
    // $lastAppointment === ['id': XX]

    // insertion appointments_users
    foreach ($participantsIds as $participantId) {
        $appointmentUserQ = $db->prepare('INSERT INTO appointments_users (appointmentId, userId) VALUES (:appointmentId, :userId);');
        $appointmentUserQ->bindParam(':appointmentId', $lastAppointment['id']);
        $appointmentUserQ->bindParam(':userId', $participantId);
        $appointmentUserQ->execute();
    }
}