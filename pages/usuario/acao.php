<?php
    require_once "../../conf/Conexao.php";

    // var_dump($_POST);
    //     echo"<br>";
    // var_dump($_GET);
    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            if ($id == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $id = isset($_GET['id']) ? $_GET['id']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM hobbies WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE hobbies SET descricao = '".$dados['descricao']."' WHERE id = '".$dados['id']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO hobbies (id, descricao) VALUES ('".$dados['id']."','".$dados['descricao']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $id = isset($_POST['id']) ? $_POST['id']: 0;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao']: '';


        $dados = array(
            'id' => $id,
            'descricao' => $descricao
        );

        return $dados;

    }

    function findById($id){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM hobbies WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>