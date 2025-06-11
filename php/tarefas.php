<?php
require 'db.php';
$stmt = $pdo->query('SELECT id, title, completed FROM Task');
$tarefas = $stmt->fetchAll();
header('Content-Type: application/json');
echo json_encode($tarefas);
