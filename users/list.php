<?php

$q = $db->prepare('SELECT * FROM users;');
$q->execute();
$result = $q->fetchAll(PDO::FETCH_ASSOC);

$html = '';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Id</th>';
$html .= '<th>First name</th>';
$html .= '<th>Last name</th>';
$html .= '<th>Email</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

// Boucler sur les données qui sont dans $result
foreach ($result as $key => $value) {
    $html .= '<tr>';
    $html .= '<td>'.$value["id"].'</td>';
    $html .= '<td>'.$value["firstName"].'</td>';
    $html .= '<td>'.$value["lastName"].'</td>';
    $html .= '<td>'.$value["email"].'</td>';
    $html .= '</tr>';
}


$html .= '</tbody>';
$html .= '</table>';



echo $html;