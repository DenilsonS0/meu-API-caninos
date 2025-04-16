<?php
$host = 'localhost';
$dbname = 'amigo_canino';
$user = 'root'; // Altere se necessário
$pass = ''; // Altere se necessário

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
