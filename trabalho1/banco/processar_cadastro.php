<?php
session_start();

// Incluir a conexão com o banco de dados
include('conexao.php');

// Se o formulário for enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar dados do cliente
    $cpf_segurado = $_POST['cpf-segurado'];
    $data_nascimento_segurado = $_POST['data-nascimento-segurado'];
    $estado_civil_segurado = $_POST['estado-civil-segurado'];
    $profissao_segurado = $_POST['profissao-segurado'];
    $email_segurado = $_POST['email-segurado'];
    $senha_segurado = $_POST['senha-segurado']; // Senha em texto claro
    $celular_segurado = $_POST['celular-segurado'];
    $reside_com_jovens = $_POST['reside-jovens'];
    $utiliza_veiculo_jovens = $_POST['uso-veiculo'];
    $cep_pernoite = $_POST['cep-pernoite'];
    $garagem_residencia = isset($_POST['garagem-residencia']) ? 1 : 0;
    $garagem_trabalho = isset($_POST['garagem-trabalho']) ? 1 : 0;
    $garagem_escola = isset($_POST['garagem-escola']) ? 1 : 0;
    $tipo_residencia = $_POST['tipo-residencia'];

    // Inserir dados na tabela clientes
    $sql_cliente = "INSERT INTO clientes (cpf_segurado, data_nascimento_segurado, estado_civil_segurado, profissao_segurado, email_segurado, senha_segurado, celular_segurado, reside_com_jovens, utiliza_veiculo_jovens, cep_pernoite, garagem_residencia, garagem_trabalho, garagem_escola, tipo_residencia) 
                    VALUES ('$cpf_segurado', '$data_nascimento_segurado', '$estado_civil_segurado', '$profissao_segurado', '$email_segurado', '$senha_segurado', '$celular_segurado', '$reside_com_jovens', '$utiliza_veiculo_jovens', '$cep_pernoite', '$garagem_residencia', '$garagem_trabalho', '$garagem_escola', '$tipo_residencia')";

    if ($conn->query($sql_cliente) === TRUE) {
        // Pegar o ID do cliente inserido
        $cliente_id = $conn->insert_id;

        // Coletar dados do veículo
        $marca_modelo = $_POST['marca-modelo'];
        $ano_fabricacao = $_POST['ano-fabricacao'];
        $placa = $_POST['placa'];
        $chassi = $_POST['chassi'];
        $uso_veiculo = $_POST['uso-veiculo'];

        // Inserir dados na tabela veiculos
        $sql_veiculo = "INSERT INTO veiculos (marca_modelo, ano_fabricacao, placa, chassi, uso_veiculo, cliente_id) 
                        VALUES ('$marca_modelo', '$ano_fabricacao', '$placa', '$chassi', '$uso_veiculo', '$cliente_id')";

        if ($conn->query($sql_veiculo) === TRUE) {
            // Redirecionar para a página de cadastro concluído
            header("Location: ../espaço.php"); // Caminho para a página de sucesso
            exit; // Importante para garantir que o script pare aqui e não execute o restante
        } else {
            echo "Erro ao cadastrar veículo: " . $conn->error;
        }
    } else {
        echo "Erro ao cadastrar cliente: " . $conn->error;
    }

    $conn->close();
}
?>
