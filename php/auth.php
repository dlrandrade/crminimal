<?php
require 'db.php';
// Exemplo básico de autenticação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare('SELECT id, password FROM User WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        echo 'ok';
    } else {
        http_response_code(401);
        echo 'erro';
    }
}
