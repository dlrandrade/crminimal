<?php
require 'db.php';
$user = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE Opportunity SET stage=? WHERE id=? AND userId=?');
    $stmt->execute([$_POST['stage'], $_POST['id'], $user]);
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Opportunity WHERE userId=?');
$stmt->execute([$user]);
echo json_encode($stmt->fetchAll());
