<?php
session_start();
// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Redirecione para a página de login se o usuário não estiver logado
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>
    <link rel="stylesheet" href="assets/css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
    <script src="assets/js/script.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #C6E2FF;
            font-family: 'Abel', sans-serif;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #fff;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px;
            margin-right: 10px;
        }

        .menu {
            display: flex;
            list-style: none;
        }

        .menu li {
            margin-right: 20px;
        }

        .menu li a {
            color: #333;
            text-decoration: none;
        }

        .menu li a:hover {
            color: #fff;
            background-color: #333;
            padding: 8px 12px;
            border-radius: 5px;
        }

        h1 {
            margin-top: 20px;
            font-family: 'Red Hat Display', sans-serif;
            font-weight: 300;
            font-size: 24px;
            text-align: center;
        }
       .t{
        width: 100%;
       }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="assets/img/Twitter.png" alt="">
            <h1># Explorar</h1>
        </div>
        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="pages/posts">+ Posts</a></p></li>
            <li><a class="logout-btn" href="login.php">Sair</a></li>
        </ul>
    </div>
     <img src="assets/img/twitter-logo.jpeg" alt="" class = "t">  
 
</body>
</html>
