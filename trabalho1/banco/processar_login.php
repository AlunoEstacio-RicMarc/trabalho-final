<?php
session_start();

include('conexao.php');
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prevenir SQL Injection
    $email = $conn->real_escape_string($email);
    $senha = $conn->real_escape_string($senha);

    // Consultar o banco de dados para encontrar o cliente
    $sql = "SELECT * FROM clientes WHERE email_segurado = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Se o email for encontrado, verificar a senha
        $row = $result->fetch_assoc();

        // Verificar se a senha fornecida é igual ao email
        if ($senha == $row['senha_segurado']) {
            // Senha correta, iniciar a sessão do cliente
            $_SESSION['cliente_id'] = $row['id'];
            $_SESSION['cliente_email'] = $row['email_segurado'];
            
            // Redirecionar para uma página protegida ou painel
            header("Location: ../index.php");
            exit();
        } else {
            // Senha incorreta
            echo "Senha incorreta.";
        }
    } else {
        // Email não encontrado
        echo "Email não encontrado.";
    }
}

$conn->close();
?>
