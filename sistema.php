<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Help Desk</title>
    <link rel="stylesheet" href="sistemacss.css">
</head>
<body>
    <header>
        <h1>Sistema de Help Desk</h1>
    </header>
    <main>
        <section class="ticket-form">
            <h2>Criar uma Solicitação de Suporte</h2>
            
            <?php
            // Configuração do banco de dados
            $host = "localhost";
            $usuario = "root";
            $senha = ""; 
            $banco = "matheus";

            $conn = new mysqli($host, $usuario, $senha, $banco);

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            // Inicialize a variável $mensagem
            $mensagem = "";

            // Verificar se o formulário foi enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_maquina = $_POST["id_maquina"];
                $assunto = isset($_POST["assunto"]) ? $_POST["assunto"] : "";
                $descricao = $_POST["descricao"];
                $data_hora = date("Y-m-d H:i:s"); // Obtém a data e hora atual no formato DATETIME

                $sql = "INSERT INTO nome (id_maquina, assunto, descrição, data_hora, status) VALUES ('$id_maquina', '$assunto', '$descricao', '$data_hora', 'pendente')";

                if ($conn->query($sql) === TRUE) {
                    $mensagem = "Solicitação enviada com sucesso!";
                } else {
                    $mensagem = "Erro no envio da solicitação: " . $conn->error;
                }
            }
            ?>

            <p><?php echo $mensagem; ?></p>
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <label for="id_maquina">ID da Máquina:</label>
                    <input type="number" id="id_maquina" name="id_maquina" required>
                </div>
                <div class="form-group">
                    <label for="assunto">Assunto:</label>
                    <input type="text" id="assunto" name="assunto" required>

                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                </div>
                <button type="submit">Enviar Solicitação</button>
            </form>
            <a href="login.php" class="botao-voltar">Voltar à Página Inicial</a>
            <?php $conn->close(); ?>
        </section>
    </main>
</body>
</html>
