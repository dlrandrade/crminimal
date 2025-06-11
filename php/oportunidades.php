<?php
require 'db.php';
$user = $_SESSION['user_id'] ?? 0;

if (!$user) {
    echo json_encode([]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['action'] ?? '') === 'create') {
        $stmt = $pdo->prepare('INSERT INTO Opportunity (title,stage,value,contactId,userId) VALUES (?,?,?,?,?)');
        $stmt->execute([
            $_POST['title'],
            'Novo',
            $_POST['value'] ?: null,
            $_POST['contactId'],
            $user
        ]);
        header('Location: ../kanban.html');
        exit;
    }
    $stmt = $pdo->prepare('UPDATE Opportunity SET stage=? WHERE id=? AND userId=?');
    $stmt->execute([$_POST['stage'], $_POST['id'], $user]);
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Opportunity WHERE userId=?');
$stmt->execute([$user]);
echo json_encode($stmt->fetchAll());
