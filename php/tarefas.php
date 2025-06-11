<?php
require 'db.php';
$user = $_SESSION['user_id'] ?? 0;

if (!$user) {
    echo json_encode([]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'create') {
        $stmt = $pdo->prepare('INSERT INTO Task (title,description,dueDate,userId) VALUES (?,?,?,?)');
        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['dueDate'],
            $user
        ]);
    }
    header('Location: ../tarefas.html');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Task WHERE userId=? ORDER BY id DESC');
$stmt->execute([$user]);
echo json_encode($stmt->fetchAll());
