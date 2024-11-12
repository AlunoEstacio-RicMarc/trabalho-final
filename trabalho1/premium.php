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
    <title>Plano Premium - Seguro de Carro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos do card para garantir que ele tenha uma largura fixa mas responsiva */
        .plan {
            border-radius: 16px;
            box-shadow: 0 30px 30px -25px rgba(0, 38, 255, 0.205);
            padding: 15px;
            background-color: #fff;
            color: #697e91;
            max-width: 600px; /* Limite máximo de largura para o card */
            width: 100%; /* O card usa 100% da largura disponível até o máximo de 600px */
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        .plan .inner {
            align-items: center;
            padding: 15px;
            background-color: #ecf0ff;
            border-radius: 12px;
            position: relative;
        }

        .plan .title {
            font-weight: 600;
            font-size: 1rem;  /* Tamanho da fonte reduzido */
            color: #425675;
            margin-bottom: 10px; /* Ajustando a margem inferior */
        }

        .plan .info {
            font-size: 0.85rem;  /* Fonte menor para descrição */
            color: #697e91;
            margin-bottom: 15px;
        }

        .plan .features {
            display: flex;
            flex-direction: column;
            gap: 5px; /* Diminui o espaço entre os itens */
        }

        .plan .features li {
            display: flex;
            align-items: center;
            gap: 8px; /* Reduz o espaçamento entre o ícone e o texto */
            font-size: 0.85rem;  /* Fonte reduzida para as ofertas */
        }

        .plan .features .icon {
            background-color: #1FCAC5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-radius: 50%;
            width: 18px;  /* Ícones menores */
            height: 18px;
        }

        .plan .action {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: end;
            margin-top: 15px;
        }

        .plan .button {
            background-color: #6558d3;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            font-size: 1rem;  /* Reduzido o tamanho da fonte do botão */
            text-align: center;
            border: 0;
            outline: 0;
            width: 100%;
            padding: 0.5em 0.75em;  /* Menor padding para o botão */
            text-decoration: none;
        }

        .plan .button:hover, .plan .button:focus {
            background-color: #4133B7;
        }

        /* Ajustes para telas menores */
        @media (max-width: 768px) {
            .plan {
                padding: 15px;
            }

            .plan .title {
                font-size: 1.1rem;  /* Ajuste do título em telas médias */
            }

            .plan .info,
            .plan .features li,
            .plan h5 {
                font-size: 0.9rem;  /* Ajuste da fonte em telas médias */
            }
        }

        /* Ajustes para telas menores que 480px */
        @media (max-width: 480px) {
            .plan {
                max-width: 100%;
                padding: 10px;
            }
            .plan .title {
                font-size: 1rem;  /* Ajuste do título em telas muito pequenas */
            }

            .plan .info,
            .plan .features li,
            .plan h5 {
                font-size: 0.8rem; /* Fonte ainda menor em telas pequenas */
            }
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
        <h2 class="text-center">Plano Premium de Seguro de Carro</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card do Plano Premium -->
                <div class="plan">
                    <div class="inner">
                        <p class="title">Seguro de Carro Premium</p>
                        <p class="info">O Seguro de Carro Premium oferece uma cobertura mais ampla e personalizada, garantindo mais segurança para o seu veículo em diversas situações. Ideal para quem busca a proteção total.</p>
                        <h5><strong>Coberturas:</strong></h5>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Danos a terceiros e roubo/furto com reembolso integral</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Acidentes naturais (granizo, alagamentos, etc.)</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Danos próprios (colisões, incêndios)</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Assistência 24h (guincho, chaveiro, etc.)</strong></span>
                            </li>
                        </ul>
                        <h5><strong>Vantagens:</strong></h5>
                        <ul class="features">
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Maior cobertura e valores mais altos de indenização</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Atendimento prioritário e mais rápido</strong></span>
                            </li>
                            <li>
                                <span class="icon">
                                    <svg height="18" width="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path fill="currentColor" d="M10 15.172l9.192-9.193 1.415 1.414L10 18l-6.364-6.364 1.414-1.414z"></path>
                                    </svg>
                                </span>
                                <span><strong>Proteção completa, com benefícios exclusivos</strong></span>
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
