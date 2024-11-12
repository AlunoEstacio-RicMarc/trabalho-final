<?php
session_start();

// Verificar se o usuário está logado
$isLoggedIn = isset($_SESSION['cliente_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre os Criadores</title>
    <link rel="stylesheet" href="styles2.css"> <!-- Link para o CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <!-- NavBar igual ao primeiro código -->
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <img src="imagens/Sistema-de-Clientes-Rio-do-A-28-09-2024.png" alt="Logo" style="height: 70px; margin-right: 15px;">
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="empresa-titulo text-center">Sobre a Rio do A: Corretagem de Seguros</h2>
        <p class="empresa-texto">A Rio do A: Corretagem de Seguros é uma empresa familiar que atua no mercado de seguros há mais de 15 anos, oferecendo uma gama de produtos para atender às necessidades de seus clientes com confiança e qualidade.</p>

        <!-- Texto sobre a seguradora de carros -->
        <h4 class="text-primary mt-5">Seguros de Carros Rio do A</h4>
        <p class="empresa-texto">A nossa corretora também se destaca pela especialização em seguros de automóveis. Contamos com uma equipe altamente capacitada para oferecer as melhores opções de cobertura para o seu veículo, com planos personalizados que atendem a diversos perfis de motorista. A Rio do A busca sempre a melhor relação custo-benefício, garantindo tranquilidade e segurança para você e sua família.</p>

        <h4>Membros da Equipe:</h4>
        <ul>
            <li>Corretora: Alessandra Sessa Zaluar</li>
            <li>Administrativo: Lucia Helena Sessa Zaluar</li>
            <li>Gestor do Site: Ricardo Zaluar Fonseca</li>
        </ul>

        <h4 class="mt-5">O que nossos clientes dizem:</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Maria Oliveira</h5>
                        <p class="card-text">"A Rio do A me proporcionou a melhor experiência na contratação do meu seguro. Super atenciosos e com ótimas opções de cobertura!"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">João da Silva</h5>
                        <p class="card-text">"Estou muito satisfeito com os serviços da Rio do A. A equipe foi atenciosa, me ajudando a escolher o seguro mais adequado para o meu carro."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Rio do A: Corretagem de Seguros.</p>
    </footer>

</body>
</html>
