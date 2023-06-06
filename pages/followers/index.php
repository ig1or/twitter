<?php
require_once "../../conf/Conexao.php";
include 'acao.php';

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$dados = array();
if ($acao == 'editar') {
    $follower_id = isset($_GET['follower_id']) ? $_GET['follower_id'] : "";
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";
    $dados = findById($follower_id, $user_id);
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
        <h1>Seguidores</h1>
        <form action="acao.php" method="post">
        <div class="mb-3">
                    <label for="follower_id">ID:</label>
                    <input type="text" class="form-control" id="follower_id" name="follower_id" value="<?php echo ($acao == 'editar') ? $dados['follower_id'] : '0'; ?>" readonly>
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
                    <th>Usuário</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexao = Conexao::getInstance();
                $consulta = $conexao->query("SELECT * FROM followers;");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {

                    $userConsulta = $conexao->query("SELECT * FROM users WHERE id = {$linha['user_id']}");
                    $user = $userConsulta->fetch(PDO::FETCH_ASSOC);

                    

                    echo "<tr>
                            <td>{$user['username']}</td>
                            <td><a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&follower_id={$linha['follower_id']}&user_id={$linha['user_id']}'>Excluir</a></td>
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
