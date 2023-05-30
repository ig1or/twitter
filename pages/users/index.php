<?php
    require_once "../../conf/Conexao.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Verifique se os campos obrigatórios foram preenchidos
        if (!empty($username) && !empty($password)) {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                // Inserção bem-sucedida
                header("Location: index.php?aviso=sucesso");
                exit;
            } else {
                // Ocorreu um erro ao inserir os dados no banco de dados
                header("Location: index.php?aviso=erro");
                exit;
            }
        } else {
            // Os campos obrigatórios não foram preenchidos
            header("Location: index.php?aviso=campos_vazios");
            exit;
        }
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .body {
            background-image: url("paper.gif");
            background-color: #f8f8f8;
            font-family: 'Irish Grover', cursive;
            padding: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#togglePassword").click(function() {
                var passwordInput = $("#password");
                var toggleButton = $(this);

                if (passwordInput.attr("type") === "password") {
                    passwordInput.attr("type", "text");
                    toggleButton.text("Ocultar Senha");
                } else {
                    passwordInput.attr("type", "password");
                    toggleButton.text("Mostrar Senha");
                }
            });
        });
    </script>
</head>
<body class="body">

    <a href="../../login.php" class="btn btn-back btn-light">Voltar</a>
    <div class="form-container">
 
        <h1>Cadastre-se</h1>
        <form action="acao.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="0" readonly>
            </div>
            <div class="form-group">
                <label for="username">Nome de Usuário:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div><br>
                <button type="button" id="togglePassword" class="btn btn-outline-secondary">Mostrar Senha</button>
            </div>
            <div class="form-group">
                <button type="submit" name="acao" class="btn btn-success" id="acao" value="salvar">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>