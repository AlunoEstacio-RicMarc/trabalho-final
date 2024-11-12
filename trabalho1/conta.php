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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #64699c;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 4px solid rgb(63, 64, 141);
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1em;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1em;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-voltar {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 8px 15px;
            background-color: transparent;
            color: white;
            
            cursor: pointer;
            font-size: 0.9em;
        }

        .btn-voltar:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .veiculo-section input {
            width: 48%;
            margin-right: 4%;
        }

        .veiculo-section input:last-child {
            margin-right: 0;
        }

        .veiculo-section {
            margin-top: 20px;
        }

        .cpf-format, .celular-format, .placa-format, .chassi-format {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .btn-editar {
            background-color: #FFC107;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            margin-right: 10px;
        }

        .btn-editar:hover {
            background-color: #ff9800;
        }

    </style>
</head>
<body>

    <a href="javascript:history.back()" class="btn-voltar">Voltar</a>

    <div class="container">
        <h1>Dados da Conta</h1>

        <form method="POST" id="form-edit">
            <h2>Informações Pessoais</h2>
            <label for="cpf_segurado">CPF:</label>
            <input type="text" id="cpf_segurado" name="cpf_segurado" value="<?php echo htmlspecialchars($cliente['cpf_segurado']); ?>" class="cpf-format" required placeholder="Somente números" maxlength="14" oninput="mascaraCPF(this)" disabled>

            <label for="data_nascimento_segurado">Data de Nascimento:</label>
            <input type="date" id="data_nascimento_segurado" name="data_nascimento_segurado" value="<?php echo htmlspecialchars($cliente['data_nascimento_segurado']); ?>" required disabled>

            <label for="estado_civil_segurado">Estado Civil:</label>
            <select id="estado_civil_segurado" name="estado_civil_segurado" disabled>
                <option value="solteiro" <?php echo ($cliente['estado_civil_segurado'] == 'solteiro') ? 'selected' : ''; ?>>Solteiro</option>
                <option value="casado" <?php echo ($cliente['estado_civil_segurado'] == 'casado') ? 'selected' : ''; ?>>Casado</option>
                <option value="divorciado" <?php echo ($cliente['estado_civil_segurado'] == 'divorciado') ? 'selected' : ''; ?>>Divorciado</option>
                <option value="viuvo" <?php echo ($cliente['estado_civil_segurado'] == 'viuvo') ? 'selected' : ''; ?>>Viuvo</option>
            </select>

            <label for="profissao_segurado">Profissão:</label>
            <input type="text" id="profissao_segurado" name="profissao_segurado" value="<?php echo htmlspecialchars($cliente['profissao_segurado']); ?>" required disabled>

            <label for="email_segurado">E-mail:</label>
            <input type="email" id="email_segurado" name="email_segurado" value="<?php echo htmlspecialchars($cliente['email_segurado']); ?>" required disabled>

            <label for="celular_segurado">Celular:</label>
            <input type="text" id="celular_segurado" name="celular_segurado" value="<?php echo htmlspecialchars($cliente['celular_segurado']); ?>" class="celular-format" required placeholder="(XX) XXXXX-XXXX" maxlength="15" oninput="mascaraCelular(this)" disabled>

            <h2>Tipo de Residência</h2>
            <label for="tipo_residencia">Tipo de Residência:</label>
            <select id="tipo_residencia" name="tipo_residencia" disabled>
                <option value="casa" <?php echo ($tipo_residencia == 'casa') ? 'selected' : ''; ?>>Casa</option>
                <option value="casa-condominio" <?php echo ($tipo_residencia == 'casa-condominio') ? 'selected' : ''; ?>>Casa em Condomínio</option>
                <option value="apartamento" <?php echo ($tipo_residencia == 'apartamento') ? 'selected' : ''; ?>>Apartamento</option>
            </select>

            <h2>Veículos</h2>
            <?php foreach ($veiculos as $index => $veiculo): ?>
            <div class="veiculo-section">
                <label for="marca_modelo_<?php echo $index; ?>">Marca/Modelo:</label>
                <input type="text" id="marca_modelo_<?php echo $index; ?>" name="marca_modelo[]" value="<?php echo htmlspecialchars($veiculo['marca_modelo']); ?>" required disabled>

                <label for="ano_fabricacao_<?php echo $index; ?>">Ano de Fabricação:</label>
                <input type="text" id="ano_fabricacao_<?php echo $index; ?>" name="ano_fabricacao[]" value="<?php echo htmlspecialchars($veiculo['ano_fabricacao']); ?>" maxlength="4" required disabled>

                <label for="placa_<?php echo $index; ?>">Placa:</label>
                <input type="text" id="placa_<?php echo $index; ?>" name="placa[]" value="<?php echo htmlspecialchars($veiculo['placa']); ?>" class="placa-format" maxlength="8" required disabled>

                <label for="chassi_<?php echo $index; ?>">Chassi:</label>
                <input type="text" id="chassi_<?php echo $index; ?>" name="chassi[]" value="<?php echo htmlspecialchars($veiculo['chassi']); ?>" maxlength="17" required disabled>
            </div>
            <?php endforeach; ?>

            <button type="submit" id="btn-enviar" style="display: none;">Atualizar Dados</button>
            <button type="button" class="btn-editar" id="btn-editar" onclick="habilitarEdicao()">Editar dados</button>
        </form>
    </div>

    <script>
        // Funções de máscara para CPF, Celular e Placa
        function mascaraCPF(campo) {
            var cpf = campo.value.replace(/\D/g, '');
            if (cpf.length <= 11) {
                campo.value = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            }
        }

        function mascaraCelular(campo) {
            var celular = campo.value.replace(/\D/g, '');
            if (celular.length <= 11) {
                campo.value = celular.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
        }

        function mascaraPlaca(campo) {
            var placa = campo.value.replace(/\D/g, '');
            if (placa.length <= 7) {
                campo.value = placa.replace(/([A-Z]{3})(\d{1,4})([A-Z]{1})/, '$1-$2$3');
            }
        }

        function habilitarEdicao() {
            // Habilita todos os campos de input
            var inputs = document.querySelectorAll('input, select');
            inputs.forEach(function(input) {
                input.disabled = false;
            });

            // Mostra o botão de enviar e esconde o botão de editar
            document.getElementById('btn-enviar').style.display = 'block';
            document.getElementById('btn-editar').style.display = 'none';
        }

        // Confirmação de envio
        document.getElementById('form-edit').onsubmit = function(e) {
            e.preventDefault(); // Previne o envio do formulário

            var confirmar = confirm("Você tem certeza que deseja atualizar os dados?");
            if (confirmar) {
                this.submit(); // Envia o formulário caso o usuário confirme
            }
        };
    </script>
</body>
</html>
