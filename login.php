<?php
session_start();

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "admin" && $password === "1234") {
        $_SESSION["admin"] = true;
        header("Location: admin.php");
        exit;
    } else {
        $erro = "Dados de acesso inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Mallone Malaquias</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<main>
    <section class="hero">
        <h2>Login Administração</h2>

        <?php if($erro): ?>
            <p style="color:red;"><?= $erro ?></p>
        <?php endif; ?>

        <form method="POST" class="form-admin">
            <input type="text" name="username" placeholder="Utilizador" required>
            <input type="password" name="password" placeholder="Palavra-passe" required>
            <button type="submit">Entrar</button>
        </form>
    </section>
</main>

</body>
</html>