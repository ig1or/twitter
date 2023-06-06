<?php
require_once "../../conf/Conexao.php";

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '';

switch ($acao) {
    case 'excluir':
        excluir();
        break;
    case 'salvar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            salvar();
        }
        break;
    case 'editar':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            editar();
        }
        break;
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("DELETE FROM comments WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: index.php");
    exit();
}


function salvar()
{
    $user_id = isset($_POST['Usuario_codigo']) ? $_POST['Usuario_codigo'] : 0;
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : '';

    // Verificar se o ID do usuário existe na tabela "users"
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // O ID do usuário é válido, prosseguir com a inserção do comentário
        $stmt = $conexao->prepare("INSERT INTO comments (content, user_id, created_at) VALUES (:content, :user_id, :created_at)");
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        header("Location: index.php");
        exit();
    } else {
        // ID do usuário não existe na tabela "users"
        echo "ID do usuário inválido";
    }
}

function formToArray()
{
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : 0;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : '';

    $dados = array(
        'id' => $id,
        'content' => $content,
        'created_at' => $created_at,
        'user_id' => $user_id,
        'post_id' => $post_id,
    );

    return $dados;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao'])) {
    if ($_POST['acao'] === 'salvar') {
        $user_id = $_POST['user_id'];
        $content = $_POST['content'];
        $created_at = $_POST['created_at'];

        $conexao = Conexao::getInstance();
        $query = "INSERT INTO comments (user_id, content, created_at) VALUES (:user_id, :content, :created_at)";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao'])) {
    if ($_GET['acao'] === 'excluir') {
        $post_id = $_GET['post_id'];
        $user_id = $_GET['user_id'];

        $conexao = Conexao::getInstance();
        $query = "DELETE FROM comments WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
}

if (isset($_GET['acao']) && $_GET['acao'] === 'editar') {
    $post_id = isset($_GET['post_id']) ? $_GET['post_id'] : 0;
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
    $dados = findById($post_id, $user_id);
}

function findById($post_id, $user_id)
{
    $conexao = Conexao::getInstance();
    $query = "SELECT * FROM comments WHERE post_id = :post_id AND user_id = :user_id";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
