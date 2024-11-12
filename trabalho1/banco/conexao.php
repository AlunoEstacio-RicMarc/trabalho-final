<?php
// Definindo os parâmetros de conexão com o banco de dados
$host = 'localhost'; // ou o endereço do seu servidor MySQL
$user = 'root';      // seu usuário do MySQL
$senha = '';         // sua senha do MySQL
$banco = 'cadastro_seguro'; // nome do banco de dados

// Cria a conexão
$conn = new mysqli($host, $user, $senha, $banco);

// Checa se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
