<?php

require 'config/database.php';

$sql = "SELECT * FROM servicos WHERE ativo = 1";
$stmt = $pdo->query($sql);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços - Mallone Malaquias</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header>
    <img src="assets/img/logo.png"
         alt="Logo Mallone Malaquias"
         class="logo">

    <h1>Mallone Malaquias</h1>
    <p>Cabeleireiro profissional</p>
</header>

<nav>
    <a href="index.php">Início</a>
    <a href="servicos.php">Serviços</a>
    <a href="contactos.php">Contactos</a>
    <a href="admin.php">Área Administrativa</a>
</nav>

<main>

    <section class="titulo-pagina">
        <h2>Os Nossos Serviços</h2>
        <p>Qualidade, estilo e profissionalismo em cada corte.</p>
    </section>

    <section class="servicos-container">

        <?php foreach($servicos as $servico): ?>

            <div class="card-servico">
                <h3><?= htmlspecialchars($servico['nome']); ?></h3>

                <p><?= htmlspecialchars($servico['descricao']); ?></p>

                <?php if(!empty($servico['preco'])): ?>
                    <p class="preco">
                        <?= number_format($servico['preco'], 2, ',', '.'); ?> €
                    </p>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>

    </section>

</main>

<footer>
    <p>&copy; 2026 Mallone Malaquias</p>
</footer>

</body>
</html>