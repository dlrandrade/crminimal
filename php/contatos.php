<?php
require 'db.php';
// Exemplo simples de listagem de contatos
$stmt = $pdo->query('SELECT id, name, email FROM Contact');
$contatos = $stmt->fetchAll();
header('Content-Type: application/json');
echo json_encode($contatos);
