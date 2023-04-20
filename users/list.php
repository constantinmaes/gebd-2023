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
$html .= '</table>';



echo $html;