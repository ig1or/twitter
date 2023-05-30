<?php 
    require_once "../../conf/Conexao.php";
?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <br>
  
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-info-circle fa-fw"></i><b class = "det">Detalhes do Contato:</b></div><br>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="card" style="width: 18rem;">
                    <?php
                            $id = isset($_GET['id']) ? $_GET['id']:0;

                            $conexao = Conexao::getInstance();
                          
                            $consulta=$conexao->query("SELECT *FROM hobbies;");
                            while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                echo "<div class='card-body'>";
                                echo "<div class='card-header'><b>ID:</b> ".$linha["id"]."</div>";
                                echo "<p class='card-text'><b>Descrição:</b> ".$linha["descricao"]."</p>";
                                echo 
                                "<a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&id=".$linha['id']."'.>Excluir</a>"."&nbsp;&nbsp;".
                                "<a class='btn btn-warning' href='index.php?acao=editar&id=".$linha['id']."'.>Editar</a>"."&nbsp;&nbsp;".
                                "<a class='btn btn-primary' href='index.php'.>Retornar</a>";
                            }
                        ?> 
                        
                    </div>
                </div>
            </div>
        </div>
 <style>
    .det{
        background-image: url("paper.gif");
        background-color: #cccccc; 
        font-family: 'Irish Grover', cursive;
        font-size: 25px;       
    }
    .card-body{
        background-image: url("paper.gif");
        background-color: #F5F5F5; 
        font-family: 'Irish Grover', cursive;
    }
 </style>    