<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM servicos WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$servico = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$servico) {
    die("Serviço não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Serviço - Mallone Malaquias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <img src="assets/img/logo.png" alt="Logo Mallone Malaquias" class="logo">
    <h1>Mallone Malaquias</h1>
    <p>Editar serviço</p>
</header>

<nav>
    <a href="admin.php">Voltar</a>
    <a href="logout.php">Sair</a>
</nav>

<main>

    <section class="titulo-pagina">
        <h2>Editar Serviço</h2>
    </section>

    <form action="atualizar_servico.php" method="POST" class="form-admin">

        <input type="hidden" name="id" value="<?= htmlspecialchars($servico['id']); ?>">

        <input type="text"
               name="nome"
               value="<?= htmlspecialchars($servico['nome']); ?>"
               required>

        <textarea name="descricao" required><?= htmlspecialchars($servico['descricao']); ?></textarea>

        <input type="number"
               name="preco"
               step="0.01"
               value="<?= htmlspecialchars($servico['preco']); ?>">

        <button type="submit">Guardar Alterações</button>

    </form>

</main>

<footer>
    <p>&copy; 2026 Mallone Malaquias</p>
</footer>

</body>
</html>