<?php
session_start();

// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "cadastro_seguro");

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID do cliente está disponível na sessão
if (isset($_SESSION['cliente_id'])) {
    $cliente_id = $_SESSION['cliente_id'];

    // Verificar se o formulário foi enviado para editar os dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Atualizar dados do cliente
        $cpf_segurado = $_POST['cpf_segurado'];
        $data_nascimento_segurado = $_POST['data_nascimento_segurado'];
        $estado_civil_segurado = $_POST['estado_civil_segurado'];
        $profissao_segurado = $_POST['profissao_segurado'];
        $email_segurado = $_POST['email_segurado'];
        $celular_segurado = $_POST['celular_segurado'];
        $tipo_residencia = $_POST['tipo_residencia'];

        // Atualizar cliente no banco de dados
        $sql_cliente = "UPDATE clientes SET cpf_segurado=?, data_nascimento_segurado=?, estado_civil_segurado=?, 
                        profissao_segurado=?, email_segurado=?, celular_segurado=?, tipo_residencia=? WHERE id=?";
        $stmt_cliente = $conn->prepare($sql_cliente);
        $stmt_cliente->bind_param("sssssssi", $cpf_segurado, $data_nascimento_segurado, $estado_civil_segurado, 
                                $profissao_segurado, $email_segurado, $celular_segurado, $tipo_residencia, $cliente_id);
        $stmt_cliente->execute();
        $stmt_cliente->close();

        // Atualizar dados do veículo se existirem
        if (isset($_POST['veiculo_id'])) {
            foreach ($_POST['veiculo_id'] as $index => $veiculo_id) {
                $marca_modelo = $_POST['marca_modelo'][$index];
                $ano_fabricacao = $_POST['ano_fabricacao'][$index];
                $placa = $_POST['placa'][$index];
                $chassi = $_POST['chassi'][$index];
                $uso_veiculo = $_POST['uso_veiculo'][$index];

                // Atualizar veículo no banco de dados
                $sql_veiculo = "UPDATE veiculos SET marca_modelo=?, ano_fabricacao=?, placa=?, chassi=?, uso_veiculo=? WHERE id=? AND cliente_id=?";
                $stmt_veiculo = $conn->prepare($sql_veiculo);
                $stmt_veiculo->bind_param("ssssssi", $marca_modelo, $ano_fabricacao, $placa, $chassi, $uso_veiculo, $veiculo_id, $cliente_id);
                $stmt_veiculo->execute();
                $stmt_veiculo->close();
            }
        }

        // Redirecionar ou exibir uma mensagem de sucesso
        echo "<p>Dados atualizados com sucesso!</p>";
    }

    // Consultar os dados do cliente com base no ID
    $sql_cliente = "SELECT * FROM clientes WHERE id = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("i", $cliente_id);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();

    if ($result_cliente->num_rows > 0) {
        $cliente = $result_cliente->fetch_assoc();
    } else {
        echo "Cliente não encontrado.";
    }

    // Consultar os veículos do cliente
    $sql_veiculos = "SELECT * FROM veiculos WHERE cliente_id = ?";
    $stmt_veiculos = $conn->prepare($sql_veiculos);
    $stmt_veiculos->bind_param("i", $cliente_id);
    $stmt_veiculos->execute();
    $result_veiculos = $stmt_veiculos->get_result();
    $veiculos = [];
    if ($result_veiculos->num_rows > 0) {
        while ($veiculo = $result_veiculos->fetch_assoc()) {
            $veiculos[] = $veiculo;
        }
    }

    // Consultar tipo de residência do cliente
    $tipo_residencia = $cliente['tipo_residencia'];

    $stmt_cliente->close();
    $stmt_veiculos->close();
    $conn->close();
} else {
    echo "ID do cliente não fornecido.";
    exit;
}
?>
