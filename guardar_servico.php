<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config/database.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

$sql = "INSERT INTO servicos (nome, descricao, preco, ativo)
        VALUES (?, ?, ?, 1)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $descricao, $preco]);

header("Location: admin.php");
exit;