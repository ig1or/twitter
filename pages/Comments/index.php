<?php
require_once "../../conf/Conexao.php";
include 'acao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$dados = array();
if ($acao == 'editar') {
    $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;
    $dados = findById($post_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentários</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .card {
            margin-bottom: 1rem;
            border: none;
        }
        .card-header {
            padding: 0.5rem 1rem;
        }
        .card-body {
            padding: 1rem;
        }
        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        textarea.form-control {
            resize: none;
        }
        .table {
            margin-bottom: 0;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding-top: 20px;
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-light a {
            text-decoration: none;
            color: #000;
        }
        .mt-3 {
            margin-top: 20px;
        }
        .mt-3 .card-header {
            background-color: #f5f8fa;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col">
                <button type="button" class="btn btn-light"><a href="../../pages/posts">Voltar</a></button>
                <h1 class="mt-3">Comentários</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <form action="acao.php" method="post">
                    <div class="card">
                        <div class="card-header">
                            Comentarista
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="form-control" name="Usuario_codigo" id="Usuario_codigo">
                                    <?php
                                    $conexao = Conexao::getInstance();
                                    $consulta = $conexao->query("SELECT * FROM users;");
                                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                        if ($linha['id'] == $dados['user_id']) {
                                            echo "<option value='" . $linha['id'] . "' selected>" . $linha['username'] . "</option>";
                                        } else {
                                            echo "<option value='" . $linha['id'] . "'>" . $linha['username'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            Comentário
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" id="content" name="content" rows="4"><?php echo ($acao == 'editar') ? $dados['content'] : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            Data de Publicação
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="datetime-local" class="form-control" id="created_at" name="created_at">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" name="acao" class="btn btn-success" id="acao" value="salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Comentarista</th>
                                    <th>Comentário</th>
                                    <th>Data Publicação</th>
                                    <th>Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conexao = Conexao::getInstance();
                                $consulta = $conexao->query("SELECT comments.*, users.username FROM comments INNER JOIN users ON comments.user_id = users.id;");
                                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                    echo "
                                        <tr>
                                            <td>{$linha['username']}</td>
                                            <td>{$linha['content']}</td>
                                            <td>{$linha['created_at']}</td>
                                            <td><a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&id={$linha['id']}'>Excluir</a></td>
                                        </tr>\n";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
