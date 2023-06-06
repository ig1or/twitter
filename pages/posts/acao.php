<?php
require_once "../../conf/Conexao.php";

$acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : '';

switch ($acao) {
    case 'excluir':
        excluir();
        break;
    case 'salvar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            if ($id == 0) {
                salvar();
            } else {
                editar();
            }
        }
        break;
}

function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// function editar()
// {
//     $dados = formToArray();

//     $conexao = Conexao::getInstance();

//     $stmt = $conexao->prepare("UPDATE posts SET content = :content, user_id = :user_id, image_url = :image_url, created_at = :created_at WHERE id = :id");

//     $stmt->bindParam(':content', $dados['content']);
//     $stmt->bindParam(':user_id', $dados['user_id']);
//     $stmt->bindParam(':image_url', $dados['image_url']);
//     $stmt->bindParam(':created_at', $dados['created_at']);
//     $stmt->bindParam(':id', $dados['id'], PDO::PARAM_INT);

//     $stmt->execute();
//     header("Location: index.php");
//     exit();
// }

function salvar()
{
    $dados = formToArray();

    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : "";


    // Verificar se o ID do usuário existe na tabela "users"
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("SELECT id FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // O ID do usuário é válido, prosseguir com a inserção do post
        $stmt = $conexao->prepare("INSERT INTO posts (id, content, user_id, image_url, created_at, hashtags) VALUES (:id, :content, :user_id, :image_url, :created_at, :hashtags)");

        $stmt->bindParam(':id', $dados['id'], PDO::PARAM_INT);
        $stmt->bindParam(':content', $dados['content']);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Correção feita aqui
        $stmt->bindParam(':image_url', $dados['image_url']);
        $stmt->bindParam(':created_at', $dados['created_at']);
        $stmt->bindParam(':hashtags', $dados['hashtags']);

        
        $stmt->execute();
        header("location:index.php");
        
    } else {
        // ID do usuário não existe na tabela "users"
        echo "ID do usuário inválido";
    }
}

function formToArray()
{
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $image_url = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $created_at = isset($_POST['created_at']) ? $_POST['created_at'] : 0;
    $user_id = isset($_POST['Usuario_codigo']) ? $_POST['Usuario_codigo'] : '';
    $hashtags = isset($_POST['hashtags']) ? $_POST['hashtags'] : '';


    $dados = array(
        'id' => $id,
        'content' => $content,
        'image_url' => $image_url,
        'created_at' => $created_at,
        'user_id' => $user_id,
        'hashtags' => $hashtags,

    );

    return $dados;
}

function findById($id)
{
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("SELECT * FROM posts WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
?>
