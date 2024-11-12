<?php
session_start();

// Verifica se o usuário está logado, assumindo que a variável $_SESSION['cliente_id'] existe
if (!isset($_SESSION['cliente_id'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
include('banco/conexao.php');

// Obtém o ID do usuário logado
$cliente_id = $_SESSION['cliente_id'];

// Recupera os dados do veículo do banco de dados
$sql = "SELECT placa, chassi, ano_fabricacao FROM veiculos WHERE cliente_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $cliente_id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o veículo
$veiculo = $result->fetch_assoc();

if (!$veiculo) {
    echo "Não foi encontrado veículo cadastrado para este cliente.";
    exit();
}

// Verifica se o formulário foi enviado para agendamento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    // Insere os dados de agendamento no banco de dados
    $sql_agendamento = "INSERT INTO agendamentos (cliente_id, data_agendamento, hora_agendamento) VALUES (?, ?, ?)";
    $stmt_agendamento = $conn->prepare($sql_agendamento);
    $stmt_agendamento->bind_param('iss', $cliente_id, $data, $hora);

    if ($stmt_agendamento->execute()) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao realizar o agendamento. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro de Agendamento</title>
    <link rel="stylesheet" href="css/pagar.css">
</head>
<body>
    <!-- Botão Voltar no canto superior esquerdo -->
    <button id="voltar" onclick="window.history.back();">Voltar</button>

    <div class="container">
        <h1>Cadastro de Agendamento</h1>
        <form method="POST" action="banco/agendamento.php">
            <!-- O PHP preencheria dados no servidor -->
            <h2>Dados do Veículo</h2>
            <label for="ano-fabricacao">Ano de Fabricação:</label>
            <input type="text" id="ano-fabricacao" name="ano-fabricacao" value="<?php echo htmlspecialchars($veiculo['ano_fabricacao']); ?>" readonly required>

            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" readonly required>

            <label for="chassi">Chassi:</label>
            <input type="text" id="chassi" name="chassi" value="<?php echo htmlspecialchars($veiculo['chassi']); ?>" readonly required>

            <h2>Agendamento</h2>
            <label for="data">Data do Agendamento:</label>
            <input type="date" id="data" name="data" required>

            <label for="hora">Hora do Agendamento:</label>
            <input type="time" id="hora" name="hora" required>

            <!-- Texto informativo sobre os meios de pagamento -->
            <div class="informativo-pagamento">
                <p><strong>Importante:</strong> Infelizmente, nossa segurança só aceita pagamentos presenciais, realizados em dinheiro, PIX ou outros meios de pagamento à vista.</p>
                <p>Por favor, agende um dia e horário para que possamos atendê-lo da melhor forma. Agradecemos sua compreensão e colaboração!</p>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

<?php
// Fecha a conexão com o banco de dados
$conn->close();
?>
