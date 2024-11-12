<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles4.css">
</head>
<body>
    <div class="back-button">
        <a href="javascript:history.back()">Voltar</a>
    </div>

    <div class="login-container">
        <h2>Login</h2>

        <!-- Exibir mensagem de erro, se houver -->
        <?php if (isset($erro)): ?>
            <div class="error-message"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="banco/processar_login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>

        <div class="register-link">
            <p>Não tem uma conta? <a href="index3.php">Faça seu cadastro</a></p>
        </div>
    </div>
</body>
</html>
