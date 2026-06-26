<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config/database.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];

$sql = "UPDATE servicos
        SET nome = ?, descricao = ?, preco = ?
        WHERE id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $descricao, $preco, $id]);

header("Location: admin.php");
exit;