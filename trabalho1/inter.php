<?php
session_start();

// Verificar se o usuário está logado
$isLoggedIn = isset($_SESSION['cliente_id']);

// Função para redirecionar ao clicar no botão contratar
function redirecionarParaPagamento() {
    global $isLoggedIn;
    if ($isLoggedIn) {
        // Redireciona para a página de pagamento
        header("Location: pagamento.php");
        exit;
    } else {
        // Exibe uma mensagem e redireciona para login
        $_SESSION['message'] = "Você precisa estar logado para contratar o plano!";
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
    <title>Plano Intermediário - Seguro de Carro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .plan {
            border-radius: 16px;
            box-shadow: 0 30px 30px -25px rgba(0, 38, 255, 0.205);
            padding: 10px;
            background-color: #fff;
            color: #697e91;
            max-width: 500px; /* Aumenta o card para os lados */
            margin-top: 50px;
        }

        .plan strong {
            font-weight: 600;
            color: #425275;
        }

        .plan .inner {
            align-items: center;
            padding: 20px;
            padding-top: 40px;
            background-color: #ecf0ff;
            border-radius: 12px;
            position: relative;
        }

        .plan .title {
            font-weight: 600;
            font-size: 1.25rem;
            color: #425675;
        }

        .plan .title + * {
            margin-top: 0.75rem;
        }

        .plan .info + * {
            margin-top: 1rem;
        }

        .plan .features {
            display: flex;
            flex-direction: column;
        }

        .plan .features li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .plan .features li + * {
            margin-top: 0.75rem;
        }

        .plan .features .icon {
            background-color: #1FCAC5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }

        .plan .features .icon svg {
            width: 14px;
            height: 14px;
        }

        .plan .features + * {
            margin-top: 1.25rem;
        }

        .plan .action {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: end;
        }

        .plan .button {
            background-color: #6558d3;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            font-size: 1.125rem;
            text-align: center;
            border: 0;
            outline: 0;
            width: 100%;
            padding: 0.625em 0.75em;
            text-decoration: none;
        }

        .plan .button:hover, .plan .button:focus {
            background-color: #4133B7;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container">
        <img src="imagens/Sistema-de-Clientes-Rio-do-A-28-09-2024.png" alt="Logo">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastro.php">Cadastrar</a>
                </li>
                <?php if (!$isLoggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="conta.php">minha Conta</a> <!-- Link para a página de Conta -->
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
        <h2 class="text-center">Plano Intermediário de Seguro de Carro</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card do Plano Intermediário -->
                <div class="plan">
                    <div class="inner">
                        <p class="title">Seguro de Carro Intermediário</p>
                        <p class="info">O Seguro de Carro Intermediário oferece uma proteção mais completa, com inclusão de danos a terceiros e proteção contra características naturais, como granizo e alagamentos. É uma boa opção para quem quer mais segurança sem gastar muito.</p>
                        <h5><strong>Coberturas:</strong></h5>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Danos a terceiros</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Granizo e alagamentos</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Proteção contra acidentes</strong></span>
                            </li>
                        </ul>
                        <h5><strong>Vantagens:</strong></h5>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Mais proteção por um custo intermediário</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Amparo em mais situações do dia a dia</strong></span>
                            </li>
                        </ul>
                        <div class="action">
                            <a class="button" href="javascript:void(0);" onclick="redirecionarParaPagamento()">
                                Contratar Agora
                            </a>
                        </div>
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
        function redirecionarParaPagamento() {
            // Caso o usuário esteja logado, redireciona para a página de pagamento
            <?php if ($isLoggedIn): ?>
                window.location.href = "pagamento.php";
            <?php else: ?>
                // Caso não esteja logado, redireciona para o login
                alert("Você precisa estar logado para contratar o plano!");
                window.location.href = "login.php";
            <?php endif; ?>
        }
    </script>
</body>
</html>
