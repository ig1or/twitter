
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        img{
            width: 50px;
        }
        body {
            background-color: #f5f8fa;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding-top: 100px;
        }
        .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: white;
            border-bottom: none;
            text-align: center;
            padding: 30px 0;
        }
        .card-body {
            background-color: white;
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 4px;
        }
        .btn-login {
            background-color: #1da1f2;
            border: none;
            border-radius: 25px;
            color: white;
            padding: 12px 30px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .btn-login:hover {
            background-color: #0c87c5;
        }
        .text-center {
            text-align: center;
        }
        .btn-signup {
            background-color: transparent;
            border: none;
            color: #1da1f2;
            font-weight: bold;
        }
        .btn-signup:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
            <img src="assets/img/Twitter.png" alt="">
                <h4>Entrar no Twitter</h4>
            </div>
            <div class="card-body">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Nome de usuário</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Nome de usuário">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-login">Entrar</button>
                </form>
                <div class="text-center mt-3">
                    <p>Não tem uma conta? <a href="pages/users/" class="btn-signup">Inscreva-se</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
    // Conecte-se ao banco de dados MySQL
    $conn = mysqli_connect("localhost", "root", '', "dep");

    // Verifique se a conexão foi estabelecida com sucesso
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';


    // Consulta SQL para verificar se as credenciais são válidas
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Verifique se a consulta retornou algum resultado
    if (mysqli_num_rows($result) == 1) {
        // Login bem-sucedido
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redireciona para a página de dashboard ou área restrita
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conn);
    // var_dump($result);
?>
