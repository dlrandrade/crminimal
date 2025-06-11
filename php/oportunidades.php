<?php
require 'db.php';
$stmt = $pdo->query('SELECT id, title, stage FROM Opportunity');
$oportunidades = $stmt->fetchAll();
header('Content-Type: application/json');
echo json_encode($oportunidades);
