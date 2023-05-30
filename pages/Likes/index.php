<?php
    require_once "../../conf/Conexao.php";

    include 'acao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $dados = array();
    if ($acao == 'editar'){
        $idContato = isset($_GET['idContato']) ? $_GET['idContato'] : 0;
        $idHobbie = isset($_GET['idHobbie']) ? $_GET['idHobbie'] : 0;
        $dados = findById($idContato,$idHobbie);
        // var_dump($dados);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Hobbies</title>
        <link rel="stylesheet" href="estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .teste{
                margin: 1vh;
            }
            .show{
                color: black;
            }
            .body{
                background-image: url("paper.gif");
                background-color: #cccccc; 
                font-family: 'Irish Grover', cursive;
            }
        </style>
    </head>
    <body class="body">
    <button type="button"class="btn btn-light"> <a href="../../index.php">Voltar</a></button>
        <h1 class ="show">Cadastro de Hobbies & Contatos</h1>
        <div class='row teste'>
            <div class='col-12 '>
                <form action="acao.php" method="post">
                    <div class='row'>
                        <div class='col-6'>
                            <label for="descricao">Contato:</label>
                            <select class="form-select" name="idContato" id="idContato">
                                    <?php
                                        $conexao = Conexao::getInstance();
                                        $consulta=$conexao->query("SELECT*FROM contatos;");
                                        while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                            if ($linha['id'] == $dados['idContato']) {
                                                echo "<option value='".$linha['id']."' selected>".$linha['nome']."</option>";
                                            }else{
                                                echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                                            }
                                        }

                                    ?>
                            </select>
                        <br>
                        </div>
                    
                        <div class='col-6'>
                            <label for="descricao">Hobbies:</label>
    
                            <select class="form-select" name="idHobbie" id="idHobbie">
                                <?php
                                    $conexao = Conexao::getInstance();
                                    $consulta=$conexao->query("SELECT*FROM hobbies;");
                                    while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                        if ($linha['id'] == $dados['idHobbie']) {
                                            echo "<option value='".$linha['id']."' selected>".$linha['descricao']."</option>";
                                        }else{
                                            echo "<option value='".$linha['id']."'>".$linha['descricao']."</option>";
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                    </div>  
                        <br>
                    <div class='row'>
                        <div class='col-12'>
                            <center><button type='submit' name='acao' class="btn btn-success" id='acao' value='salvar'>Salvar</button></center>
                        </div>
                    </div>       
                </form>
            </div>
        </div> 
        <div class='row'>
            <?php

            ?>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Contato</th>
                            <th>Hobbie</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *FROM contato_hobbie;");
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "
                                        <td>{$linha['idContato']}</td>
                                        <td>{$linha['idHobbie']}</td>
                                        <td><a class='btn btn-warning' href='index.php?acao=editar&idContato={$linha['idContato']}&idHobbie={$linha['idHobbie']}'>Editar</a></td>
                                        <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&idContato={$linha['idContato']}&idHobbie={$linha['idHobbie']}'>Excluir</a></td>
                                        </tr>\n
                                    ";
                                
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>