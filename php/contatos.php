<?php
require 'db.php';
$user = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'create') {
        $stmt = $pdo->prepare('INSERT INTO Contact (name,email,phone,company,notes,userId) VALUES (?,?,?,?,?,?)');
        $stmt->execute([
            $_POST['name'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['company'],
            $_POST['notes'],
            $user
        ]);
    }
    header('Location: ../contatos.html');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM Contact WHERE userId=? ORDER BY id DESC');
$stmt->execute([$user]);
echo json_encode($stmt->fetchAll());
