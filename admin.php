<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

require 'config/database.php';

$sql = "SELECT * FROM servicos ORDER BY id DESC";
$stmt = $pdo->query($sql);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Administração - Mallone Malaquias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <img src="assets/img/logo.png" alt="Logo Mallone Malaquias" class="logo">
    <h1>Mallone Malaquias</h1>
    <p>Área de administração</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="servicos.php">Serviços</a>
    <a href="contactos.php">Contactos</a>
    <a href="logout.php">Sair</a>
</nav>

<main>

    <section class="titulo-pagina">
        <h2>Gestão de Serviços</h2>
        <p>Adiciona, edita ou apaga serviços.</p>
    </section>

    <form action="guardar_servico.php" method="POST" class="form-admin">

        <input type="text" name="nome" placeholder="Nome do serviço" required>

        <textarea name="descricao" placeholder="Descrição do serviço" required></textarea>

        <input type="number" name="preco" step="0.01" placeholder="Preço">

        <button type="submit">Adicionar Serviço</button>

    </form>

    <section class="admin-container">

        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Serviço</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Activo</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($servicos as $servico): ?>
                    <tr>
                        <td><?= htmlspecialchars($servico['id']); ?></td>

                        <td><?= htmlspecialchars($servico['nome']); ?></td>

                        <td><?= htmlspecialchars($servico['descricao']); ?></td>

                        <td>
                            <?php if(!empty($servico['preco'])): ?>
                                <?= number_format($servico['preco'], 2, ',', '.'); ?> €
                            <?php else: ?>
                                Sem preço
                            <?php endif; ?>
                        </td>

                        <td>
                            <?= $servico['ativo'] == 1 ? 'Sim' : 'Não'; ?>
                        </td>

                        <td>
                            <a class="btn-editar"
                               href="editar_servico.php?id=<?= $servico['id']; ?>">
                                Editar
                            </a>

                            <a class="btn-apagar"
                               href="apagar_servico.php?id=<?= $servico['id']; ?>"
                               onclick="return confirm('Tens a certeza que queres apagar este serviço?');">
                                Apagar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>

</main>

<footer>
    <p>&copy; 2026 Mallone Malaquias</p>
</footer>

</body>
</html>