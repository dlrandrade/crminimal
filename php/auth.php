<?php
require 'db.php';
$action = $_POST['action'] ?? '';

if ($action === 'register') {
    $stmt = $pdo->prepare('INSERT INTO User (name,email,password) VALUES (?,?,?)');
    $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->execute([$_POST['name'], $_POST['email'], $hash]);
    header('Location: ../index.html');
    exit;
}

if ($action === 'login') {
    $stmt = $pdo->prepare('SELECT * FROM User WHERE email = ?');
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../dashboard.html');
    } else {
        header('Location: ../index.html');
    }
    exit;
}
?>
