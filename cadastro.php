<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Tela de Cadastro</title>
</head>
<body>
    <div class="container">
        <?php
        // Configuração do banco de dados
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "matheus";

        // Conexão com o banco de dados
        $conn = new mysqli($host, $usuario, $senha, $banco);

        // Verifica se a conexão foi bem-sucedida
        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        $mensagem = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Coleta os dados do formulário
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $tipo = $_POST["tipo"];

            // Verifica se o email já está cadastrado
            $check_sql = "SELECT * FROM tega WHERE email = '$email'";
            $result = $conn->query($check_sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    $mensagem = "O email já está cadastrado. Use outro email.";
                } else {
                    // Prepara e executa a consulta de inserção
                    $sql = "INSERT INTO tega (email, senha, tipo) VALUES ('$email', '$senha', '$tipo')";

                    if ($conn->query($sql) === TRUE) {
                        $mensagem = "Dados inseridos com sucesso!";
                    } else {
                        $mensagem = "Erro na inserção de dados: " . $conn->error;
                    }
                }
            }
        }
        ?>

        <form class="cadastro-form" class="form" method="POST" action="">
            <h1>Cadastro</h1>
            <div class="form-group">
                <label for "email">Email (utilizado como login):</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="user-type">Tipo de Usuário</label>
                <select id="user-type" name="tipo">
                    <option value="funcionario">Funcionário</option>
                    <option value="atendente">Atendente</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <button type="submit">Cadastrar</button>
        </form>

        <p id="mensagem" style="color: white; display: <?php echo empty($mensagem) ? 'none' : 'block'; ?>"><?php echo $mensagem; ?></p>
        <?php if (!empty($mensagem)) : ?>
            <a href="login.php" class="botao-voltar">Voltar à Página Principal</a>
        <?php endif; ?>
    </div>
</body>
</html>
