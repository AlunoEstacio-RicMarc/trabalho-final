<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro</title>
    <!-- Link para o arquivo CSS externo -->
    <link rel="stylesheet" href="css/styles3.css">
    <script src="java/tela_de_cadastro.js"></script>
</head>
<body>
    <!-- Botão Voltar no canto superior esquerdo -->
    <a href="javascript:history.back()" class="btn-voltar">Voltar</a>

    <div class="container">
        <script src="java/condutor.js"></script>
        <h1>Cadastro de Seguro</h1>
        <form method="POST" action="banco/processar_cadastro.php">
            <h2>Segurado</h2>
            <label for="cpf-segurado">CPF:</label>
            <input type="text" id="cpf-segurado" name="cpf-segurado" required placeholder="Somente números" class="cpf-format">

            <label for="data-nascimento-segurado">Data de Nascimento:</label>
            <input type="date" id="data-nascimento-segurado" name="data-nascimento-segurado" required>

            <label for="estado-civil-segurado">Estado Civil:</label>
            <select id="estado-civil-segurado" name="estado-civil-segurado">
                <option value="solteiro">Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viuvo">Viuvo</option>
            </select>


            <label for="profissao-segurado">Profissão:</label>
            <input type="text" id="profissao-segurado" name="profissao-segurado" required>

            <label for="email-segurado">E-mail:</label>
            <input type="email" id="email-segurado" name="email-segurado" required>

            <label for="senha-segurado">Senha:</label>
<input type="password" id="senha-segurado" name="senha-segurado" required placeholder="Digite a senha">

            <label for="celular-segurado">Celular:</label>
            <input type="text" id="celular-segurado" name="celular-segurado" class="celular-format" placeholder="(XX) XXXXX-XXXX" maxlength="15" required >

            <h2>Condutor</h2>   
            <input type="radio" id="opcao1" name="opcao" value="1" onchange="condutorMesmo()">
            <label for="opcao1">Mesmo que o segurado</label><br>

            <input type="radio" id="opcao2" name="opcao" value="2" onchange="condutorMesmo()">
            <label for="opcao2">Outro</label><br><br>
            
            <label for="cpf-condutor">CPF:</label>
            <input type="text" id="cpf-condutor" name="cpf-condutor" placeholder="Somente números" class="cpf-format" disabled>

            <label for="data-nascimento-condutor">Data de Nascimento:</label>
            <input type="date" id="data-nascimento-condutor" name="data-nascimento-condutor" disabled>

            <label for="estado-civil-condutor">Estado Civil:</label>
            <select id="estado-civil-condutor" name="estado-civil-condutor">
                <option value="solteiro">Solteiro</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viuvo">Viuvo</option>
            </select>

            <label for="profissao-condutor">Profissão:</label>
            <input type="text" id="profissao-condutor" name="profissao-condutor" disabled>

            <h2>Reside com pessoas entre 17 e 25 anos:</h2>
            <label><input type="radio" name="reside-jovens" value="sim"> Sim</label>
            <label><input type="radio" name="reside-jovens" value="nao"> Não</label>

            <label>Se afirmativo, utilizam veículo até 15% do tempo de circulação:</label>
            <label><input type="radio" name="uso-veiculo" value="sim"> Sim</label>
            <label><input type="radio" name="uso-veiculo" value="nao"> Não</label>

            <h2>CEP de Pernoite:</h2>
            <label for="cep-pernoite">CEP:</label>
            <input type="text" id="cep-pernoite" name="cep-pernoite" class="cepFormat" maxlength="9" placeholder="XXXXX-XXX">

            <h2>Garagem</h2>
            <label><input type="checkbox" name="garagem-residencia"> Na Residência</label>
            <label><input type="checkbox" name="garagem-trabalho"> No Trabalho</label>
            <label><input type="checkbox" name="garagem-escola"> Na Escola/Faculdade</label>

            <label for="tipo-residencia">Tipo de Residência:</label>
            <select id="tipo-residencia" name="tipo-residencia">
                <option value="casa">Casa</option>
                <option value="casa-condominio">Casa em Condomínio</option>
                <option value="apartamento">Apartamento</option>
            </select>

            <h2>Dados do Veículo</h2>
            <label for="marca-modelo">Marca/Modelo:</label>
            <input type="text" id="marca-modelo" name="marca-modelo" required>

            <label for="ano-fabricacao">Ano Fabricação/Modelo:</label>
            <input type="text" id="ano-fabricacao" name="ano-fabricacao" class="anoModelo" maxlength="9" placeholder="XXXX/XXXX" required>

            <label for="placa">Placa:</label>
            <input type="text" id="placa" name="placa" class="placaVeiculo" maxlength="8" placeholder="AAA-1234 ou AAA1A23" required>

            <label for="chassi">Chassi:</label>
            <input type="text" id="chassi" name="chassi" required>

            <h2>Uso do Veículo</h2>
            <label>
                <input type="radio" name="uso-veiculo" value="Particular"> Particular
            </label>
            <label>
                <input type="radio" name="uso-veiculo" value="Prestação de serviço"> Prestação de serviço
            </label>
            <label>
                <input type="radio" name="uso-veiculo" value="Visita a clientes/fornecedores"> Visita a clientes/fornecedores
            </label>
            <label>
                <input type="radio" name="uso-veiculo" value="Aplicativo"> Aplicativo
            </label>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
