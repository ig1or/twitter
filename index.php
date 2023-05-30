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
    <?php
        $aviso = isset($_GET['aviso']) ? $_GET['aviso'] : ""; 

        switch ($aviso) {
            case 'sucesso':
                $msg = "Proposta Enviada com Sucesso!";
                alert($msg);
                break;
            default:
                # code...
                break;
        }
        function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    ?> 
</head>
<style>
        img{
            width: 50px;
        }
        body{
            background-color: #C6E2FF;
        }
        .menu{
            list-style:none;
            border:1px solid #c0c0c0;
            float:left;
            }
        .menu li{
        position:relative;
        float:left;
        border-right:1px solid #c0c0c0;
        }
        .menu li a{color:#333; text-decoration:none; padding:5px 10px; display:block;}

        .menu li a:hover{
        background:#333;
        color:#fff;
        -moz-box-shadow:0 3px 10px 0 #CCC;
        -webkit-box-shadow:0 3px 10px 0 #ccc;
        text-shadow:0px 0px 5px #fff;
        }
</style>
    <body>
    <nav>
  <ul class="menu">
		<li><a href="#">Home - ></a></li>
	  
	  	<li><a class="logout-btn" href="login.php">Sair</a></li>
</ul>
</nav>
      <img src="assets/img/Twitter.png" alt="">
        <h1># Explorar</h1>
      <img src="assets/img/conf.png" alt="">
      <li><a href="pages/posts">+ Posts</a>
    </body>
    