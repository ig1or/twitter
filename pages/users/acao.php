<?php
    require_once "../../conf/Conexao.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Verifique se os campos obrigatórios foram preenchidos
        if (!empty($username) && !empty($password)) {
            $conexao = Conexao::getInstance();

            $stmt = $conexao->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                // Inserção bem-sucedida
                header("Location: index.php?aviso=sucesso");
                exit;
            } else {
                // Ocorreu um erro ao inserir os dados no banco de dados
                header("Location: index.php?aviso=erro");
                exit;
            }
        } else {
            // Os campos obrigatórios não foram preenchidos
            header("Location: index.php?aviso=campos_vazios");
            exit;
        }
    }
?>
