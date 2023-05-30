<?php
require_once "../../conf/Conexao.php";
    
$acao = "";
switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
    case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
}

switch($acao){
    case 'excluir': excluir(); break;
    case 'salvar': {
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : "";
        if ($codigo == 0)
            salvar(); 
        else
            editar();
        break;
    }
}

function excluir(){    
    $codigo = isset($_GET['codigo']) ? $_GET['codigo']:0;
    $conexao = Conexao::getInstance();
    $stmt = $conexao->prepare("DELETE FROM atleta WHERE codigo = :codigo");
    $stmt->bindParam('codigo', $codigo, PDO::PARAM_INT);  
    $stmt->execute();
    header("location:index.php");
}

function editar(){
    
    $dados = formToArray();

    $conexao = Conexao::getInstance();

    $sql = "UPDATE atleta SET nome = '".$dados['nome'].
           "',peso = '".$dados['peso']."', altura = '".$dados['altura'].
           "'WHERE codigo = ".$dados['codigo'].";";

    $conexao = $conexao->query($sql);
    header("location:index.php");
}

function salvar(){
    
    $dados = formToArray();

    //var_dump($dados);

    $conexao = Conexao::getInstance();

    $sql = "INSERT INTO atleta (nome, peso, altura) 
            VALUES ('".$dados['nome']."', '".$dados['peso']."', 
            '".$dados['altura']."')";
    
    $conexao = $conexao->query($sql);
    header("location:index.php");
}

function formToArray(){
    $codigo = isset($_POST['codigo']) ? $_POST['codigo']: 0;
    $nome = isset($_POST['nome']) ? $_POST['nome']: 0;
    $peso = isset($_POST['peso']) ? $_POST['peso']: 0;
    $altura = isset($_POST['altura']) ? $_POST['altura']: 0;

    $dados = array(
        'codigo' => $codigo,
        'nome' => $nome,
        'peso' => $peso,
        'altura' => $altura
    );

    return $dados;

}


function findById($codigo){
    $conexao = Conexao::getInstance();
    $conexao = $conexao->query("SELECT * FROM atleta WHERE codigo = $codigo;");
    $result = $conexao->fetch(PDO::FETCH_ASSOC);
    return $result; 
}

?>