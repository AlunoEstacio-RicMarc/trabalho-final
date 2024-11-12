<?php
session_start();

// Verificar se o usuário está logado
$isLoggedIn = isset($_SESSION['cliente_id']);

// Função para redirecionar ao clicar nos cards
function redirecionarPlano($plano) {
    global $isLoggedIn;
    if ($isLoggedIn) {
        // Redireciona para a página específica do plano
        if ($plano == 'basico') {
            header("Location: basico.php"); // Redireciona para basico.php
        } else {
            header("Location: ofertas.php?plano=$plano"); // Redireciona para ofertas.php para outros planos
        }
        exit;
    } else {
        // Exibe uma mensagem e redireciona para login
        $_SESSION['message'] = "Você precisa estar logado para acessar as ofertas!";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
 <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <img src="imagens/Sistema-de-Clientes-Rio-do-A-28-09-2024.png" alt="Logo">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="cadastro.php">Cadastrar</a>
                </li>
                <?php if (!$isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php else: ?>
                    <!-- Link para a página "Conta" -->
                    <li class="nav-item">
                        <a class="nav-link" href="conta.php">Minha Conta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="banco/sair.php">Sair</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="sobre.php">Sobre Nós</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="container main-content">
        <h2>Bem-vindo ao nosso sistema!</h2>
        <p>Aqui você pode gerenciar os dados dos seus clientes e seguros, além de explorar nossas novas ofertas.</p>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="palette">
                        <!-- Card para Plano Básico -->
                        <div class="color" onclick="redirecionarPlano('basico')">
                            <span>
                                <strong>Plano Básico</strong><br>
                                Proteção essencial a um custo acessível.
                            </span>
                            <div class="info">
                                <strong>Conheça os Benefícios do Nosso Plano Básico de Seguros</strong><br>
                            </div>
                        </div>
                        <!-- Card para Plano Intermediário -->
                        <div class="color" onclick="redirecionarPlano('intermediario')">
                            <span>
                                <strong>Plano Intermediário</strong><br>
                                Cobertura ampliada e benefícios adicionais.
                            </span>
                            <div class="info">
                                <strong>Descubra os Benefícios do Nosso Plano Intermediário</strong><br>
                            </div>
                        </div>
                        <!-- Card para Plano Premium -->
                        <div class="color" onclick="redirecionarPlano('premium')">
                            <span>
                                <strong>Plano Premium</strong><br>
                                A melhor proteção com serviços exclusivos.
                            </span>
                            <div class="info">
                                <strong>Explore os Benefícios do Nosso Plano Premium</strong><br>
                            </div>
                        </div>
                    </div>
                    <div class="footer-message">
                        Escolha o plano que mais se adequa às suas necessidades
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 Rio do A: Corretagem de Seguros. Todos os direitos reservados.</p>
        <div>
            <i class="fas fa-phone"> (21) 90028922</i>
            <i class="fas fa-envelope"> exemplodeemail@gmail.com</i>
        </div>
    </footer>

    <script>
        function redirecionarPlano(plano) {
            // Caso o usuário esteja logado, redireciona para a página do plano
            <?php if ($isLoggedIn): ?>
                window.location.href = "basico.php"; // Para o plano básico
                if (plano === 'intermediario') {
                    window.location.href = "inter.php"; // Para plano intermediário
                } else if (plano === 'premium') {
                    window.location.href = "premium.php"; // Para plano premium
                }
            <?php else: ?>
                // Caso não esteja logado, redireciona para o login
                alert("Você precisa estar logado para acessar as ofertas!");
                window.location.href = "login.php";
            <?php endif; ?>
        }
    </script>
</body>
</html>

