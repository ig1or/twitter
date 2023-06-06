<?php 
require_once "../../conf/Conexao.php";

$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : "";

switch ($acao) {
    case 'excluir':
        excluir();
        break;
    case 'salvar':
        if (findById($user_id) == NULL)
            salvar();
        else
            editar();
        break;
}

function excluir()
{
    $follower_id = isset($_GET['follower_id']) ? $_GET['follower_id'] : 0;
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("DELETE FROM followers WHERE follower_id = :follower_id");
    $stmt->bindParam(':follower_id', $follower_id, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

function salvar()
{
    $dados = formToArray();

    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("INSERT INTO followers (follower_id, user_id) VALUES (:follower_id, :user_id)");
    $stmt->bindParam(':follower_id', $dados['follower_id']);
    $stmt->bindParam(':user_id', $dados['user_id']);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

function formToArray()
{
    $follower_id = isset($_POST['follower_id']) ? $_POST['follower_id'] : "";
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : "";

    $dados = array(
        'follower_id' => $follower_id,
        'user_id' => $user_id
    );

    return $dados;
}

function findById($user_id)
{
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("SELECT * FROM followers WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}
?>