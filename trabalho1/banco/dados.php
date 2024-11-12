<?php
// Conectar ao banco de dados MySQL usando PDO
$servername = "localhost";
$username = "root";  // Usuário do banco de dados
$password = "";      // Senha do banco de dados
$dbname = "meubanco"; // Nome do banco de dados

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}

// Buscar dados do cliente
$cliente_id = 1;  // Exemplo, você pode pegar isso de uma sessão ou URL
$sql = "SELECT * FROM clientes WHERE cliente_id = :cliente_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':cliente_id', $cliente_id);
$stmt->execute();
$dados_cliente = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não encontrou o cliente
if (!$dados_cliente) {
    die("Cliente não encontrado.");
}
?>

<!-- Formulário dinâmico -->
<form id="cardForm" method="POST" action="atualiza_dados.php">
    <label for="nome">Nome</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados_cliente['nome']); ?>" required>

    <label for="cpf">CPF</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($dados_cliente['cpf']); ?>" required>

    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($dados_cliente['email_seguro']); ?>" required>

    <label for="data_nascimento">Data de Nascimento</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($dados_cliente['data_nascimento_segurado']); ?>" required>

    <label for="celular">Celular</label>
    <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($dados_cliente['celular_seguro']); ?>" required>

    <label for="estado_civil">Estado Civil</label>
    <select id="estado_civil" name="estado_civil">
        <option value="solteiro" <?php echo $dados_cliente['estado_civil_segurado'] == 'solteiro' ? 'selected' : ''; ?>>Solteiro</option>
        <option value="casado" <?php echo $dados_cliente['estado_civil_segurado'] == 'casado' ? 'selected' : ''; ?>>Casado</option>
        <option value="divorciado" <?php echo $dados_cliente['estado_civil_segurado'] == 'divorciado' ? 'selected' : ''; ?>>Divorciado</option>
    </select>

    <label for="profissao">Profissão</label>
    <input type="text" id="profissao" name="profissao" value="<?php echo htmlspecialchars($dados_cliente['profissao_segurado']); ?>" required>

    <!-- Outros campos que você quiser adicionar -->

    <button type="submit">Salvar Informações</button>
</form>
