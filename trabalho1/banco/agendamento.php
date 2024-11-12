<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cliente_id'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Obtém o cliente_id da sessão
$cliente_id = $_SESSION['cliente_id'];

// Busca os dados do veículo do cliente no banco de dados
$sql_veiculo = "SELECT placa, chassi, ano_fabricacao FROM veiculos WHERE cliente_id = ?";
$stmt_veiculo = $conn->prepare($sql_veiculo);
$stmt_veiculo->bind_param('i', $cliente_id);
$stmt_veiculo->execute();
$stmt_veiculo->store_result();
$stmt_veiculo->bind_result($placa, $chassi, $ano_fabricacao);

// Se o cliente tiver um veículo cadastrado, preenche as variáveis
if ($stmt_veiculo->fetch()) {
    // Dados do veículo encontrados
} else {
    echo "Nenhum veículo encontrado para este cliente.";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $data_agendamento = $_POST['data'];
    $hora_agendamento = $_POST['hora'];

    // Insere os dados de agendamento no banco de dados
    $sql_agendamento = "INSERT INTO agendamentos (cliente_id, data_agendamento, hora_agendamento, placa, chassi, ano_fabricacao) 
                        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_agendamento = $conn->prepare($sql_agendamento);
    $stmt_agendamento->bind_param('isssss', $cliente_id, $data_agendamento, $hora_agendamento, $placa, $chassi, $ano_fabricacao);

    if ($stmt_agendamento->execute()) {
        // Redireciona para a página de confirmação
        header('Location: ../agenda.php');
        exit(); // Certifique-se de que o script termina após o redirecionamento
    } else {
        echo "Erro ao realizar o agendamento. Tente novamente.";
    }

    // Fecha a conexão com o banco de dados
    $stmt_agendamento->close();
}

$stmt_veiculo->close();
$conn->close();
?>

