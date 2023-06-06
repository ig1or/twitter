<?php
    require_once "../../conf/Conexao.php";

    // var_dump($_POST);
        echo"<br>";
    // var_dump($_GET);
    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    $post_id = isset($_GET['post_id']) ? $_GET['post_id']: "";
    $user_id = isset($_GET['user_id']) ? $_GET['user_id']: "";

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            if (findById($post_id,$user_id) == NULL)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){  
        echo "FUNCTION EXCLUIR";  


        $post_id = isset($_GET['post_id']) ? $_GET['post_id']: 0;
        $user_id = isset($_GET['user_id']) ? $_GET['user_id']: 0;

        $dados = formToArray();
        $conexao = Conexao::getInstance();
        $sql = "DELETE FROM reposts WHERE post_id = '$post_id' AND user_id = '$user_id';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function editar(){
        $post_id = isset($_GET['post_id']) ? $_GET['post_id']: "";
        $user_id = isset($_GET['user_id']) ? $_GET['user_id']: "";

        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();
        $sql = "UPDATE `reposts` SET `post_id` = '".$dados['post_id']."', `user_id` = '".$dados['user_id']."' WHERE (`post_id` = '".$post_id.") and (`user_id` = '".$user_id."');";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        // var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO reposts (post_id, user_id) VALUES ('".$dados['post_id']."','".$dados['user_id']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $post_id = isset($_POST['post_id']) ? $_POST['post_id']: 0;
        $user_id = isset($_POST['user_id']) ? $_POST['user_id']: 0;


        $dados = array(
            'post_id' => $post_id,
            'user_id' => $user_id
        );

        return $dados;

    }

    function findById($post_id, $user_id){
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM reposts WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }
    

?>