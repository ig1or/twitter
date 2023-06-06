<?php

require_once "../../conf/Conexao.php";
include 'acao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$dados = array();
if ($acao == 'editar') {
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $dados = findById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_error = $image['error'];

        if ($image_error === UPLOAD_ERR_OK) {
            $destination = "../../assets/img/" . $image_name;
            move_uploaded_file($image_tmp_name, $destination);
            $image_url = "http://twitter/assets/img/" . $image_name;
        } else {
            // Error uploading image
        }
    }

    // Rest of your code to save the data and perform other actions
    // ...
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar</title>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        img{
            width: 50%;
        }
        .comentario{
            width: 25px;
        }
        .image-list {
            list-style-type: none;
            display: flex;
        }
        .image-list li {
            margin-right: 10px; /* Ajuste o espaçamento horizontal conforme necessário */
        }
        body {
            background-image: url("paper.gif");
            background-color: #f5f8fa;
            font-family: 'Irish Grover', cursive;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="file"],
        .form-group input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .form-group img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
        .form-group .btn {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            background-color: #1da1f2;
            color: #fff;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            outline: none;
        }
        .form-group .btn:hover {
            background-color: #0c87b8;
        }
        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card .content {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .card .actions {
            display: flex;
            margin-top: 10px;
        }
        .card .actions .btn {
            margin-right: 10px;
            padding: 8px 16px;
            font-size: 14px;
        }
        .card .actions .btn:last-child {
            margin-right: 0;
        }
        .card img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            border-radius: 12px;
        }
        .card .created-at {
            font-size: 12px;
            color: #657786;
        }
        .logo {
            width: 200px;
            margin: 0 auto;
            display: block;
            margin-bottom: 20px;
        }
        .btn-back {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <img src="assets/img/Twitter.png" alt="" class="logo">
    <div class="container">
        <a class="btn btn-light btn-back" href="../../index.php">Voltar</a>
        <h1>Cadastro de Publicação</h1>

        <!-- ... código anterior ... -->

        <div class="card">
            <form action="acao.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id">ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?php echo ($acao == 'editar') ? $dados['id'] : '0'; ?>" readonly>
                </div>
                <div>
                    <label class="form-label" for="user_id">Usuário</label>
                    <select class="form-select" name="user_id" id="user_id">
                        <?php
                        $conexao = Conexao::getInstance();

                        $filtro = ""; // Defina o valor de filtro adequado aqui

                        $consulta = $conexao->prepare("SELECT * FROM users WHERE username LIKE :filtro");
                        $consulta->bindValue(':filtro', '%' . $filtro . '%');
                        $consulta->execute();

                        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $linha['id'] . "'>" . $linha['username'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Conteúdo:</label>
                    <textarea class="form-control" id="content" name="content" rows="4"><?php echo ($acao == 'editar') ? $dados['content'] : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="hashtags">Hashtags:</label>
                    <input type="" class="form-control" id="hashtags" name="hashtags" value = "#">
                </div>

                <div class="form-group">
                    <label for="created_at">Data Criação:</label>
                    <input type="datetime-local" class="form-control" id="created_at" name="created_at">
                </div>
                <div class="form-group">
                    <label for="image">Imagem:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <?php if ($acao == 'editar' && !empty($dados['image_url'])): ?>
                        <img src="<?php echo $dados['image_url']; ?>" alt="Imagem">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="acao" id="acao" value="salvar">Salvar</button>
                </div>
            </form>
        </div>

        <!-- ... código posterior ... -->

        <div>
        <?php
        $conexao = Conexao::getInstance();
        $consulta = $conexao->query("SELECT p.*, u.username FROM posts p INNER JOIN users u ON p.user_id = u.id;");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $image_url = "http://{$_SERVER['HTTP_HOST']}/twitter/assets/img/{$linha['image_url']}";

            // Extrair as hashtags da publicação atual
            $hashtags = explode(',', $linha['hashtags']);

            echo "<div class='card'>
        Criado por<div class='content'>{$linha['username']}</div>
        <div class='content'>{$linha['content']}{$linha['hashtags']}</div>
        <img src='{$image_url}' alt='Imagem'>
        <div class='created-at'>{$linha['created_at']}</div>
        <ul class='image-list'>
            <li>
                <a href='../../pages/Comments'>
                    <img src='../../assets/img/comentario.png' alt='' class='comentario'>
                </a>
            </li>
            <li>
                <a href='../../pages/reposts'>
                    <img src='../../assets/img/retuitar.png' alt='' class='comentario'>
                </a>
            </li>
            <li>
                <a href='../../pages/Likes'>
                    <img src='../../assets/img/like.png' alt='' class='comentario'>
                </a>
            </li>
            <li>
                <a href='../../pages/followers'>
                    <img src='../../assets/img/view.png' alt='' class='comentario'>
                </a>
            </li>
        </ul>
        <div class='actions'>
            <a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&id={$linha['id']}'>Excluir</a>
        </div>
    </div>";
        }
        ?>
        </div>
    </div>

    <script>
        function excluir() {
            return confirm("Deseja realmente excluir esta publicação?");
        }
    </script>
</body>
</html>
