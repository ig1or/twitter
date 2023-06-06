<?php
require_once "../../conf/Conexao.php";
include 'acao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$dados = array();
if ($acao == 'editar') {
    $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
    $dados = findById($post_id, $user_id);
    // var_dump($dados);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reposts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("paper.gif");
            background-color: #f5f8fa;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #14171a;
        }

        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .btn {
            margin-top: 10px;
        }

        .table {
            margin-top: 20px;
        }

        th {
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <a class="btn btn-primary" href="../../pages/posts/">Voltar</a>
        <h1>Retuitar</h1>
        <form action="acao.php" method="post">
            <div class="mb-3">
                <label for="post_id" class="form-label">Post:</label>
                <select class="form-select" name="post_id" id="post_id">
                    <?php
                    $conexao = Conexao::getInstance();
                    $consulta = $conexao->query("SELECT * FROM posts;");
                    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        if ($linha['id'] == $dados['post_id']) {
                            echo "<option value='" . $linha['id'] . "' selected>" . $linha['content'] . "</option>";
                        } else {
                            echo "<option value='" . $linha['id'] . "'>" . $linha['content'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Usuário:</label>
                <select class="form-select" name="user_id" id="user_id">
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
            <button type="submit" class="btn btn-success" name="acao" value="salvar">Salvar</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Publicação</th>
                    <th>Usuário</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexao = Conexao::getInstance();
                $consulta = $conexao->query("SELECT * FROM reposts;");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $postConsulta = $conexao->query("SELECT * FROM posts WHERE id = {$linha['post_id']}");
                    $post = $postConsulta->fetch(PDO::FETCH_ASSOC);

                    $userConsulta = $conexao->query("SELECT * FROM users WHERE id = {$linha['user_id']}");
                    $user = $userConsulta->fetch(PDO::FETCH_ASSOC);

                    echo "<tr>
                            <td>{$post['content']}</td>
                            <td>{$user['username']}</td>
                            <td><a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&post_id={$linha['post_id']}&user_id={$linha['user_id']}'>Excluir</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function excluir() {
            return confirm("Tem certeza que deseja excluir?");
        }
    </script>
</body>

</html>
