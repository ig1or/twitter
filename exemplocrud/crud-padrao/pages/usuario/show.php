<?php 
    require_once "../../conf/Conexao.php";
    include '../header.php' 
?>
    <head>
        <script src="../../assets/js/script.js"></script>
    </head>
    <div class="container-fluid">
    <br>
   <a class='btn btn-secondary'href="index.php">Consultar</a>
   <br><br>

    <div class="card" style="width: 18rem;">
<?php
    $codigo = isset($_GET['codigo']) ? $_GET['codigo']:0;

    $conexao = Conexao::getInstance();
    $consulta=$conexao->query("SELECT*FROM atleta where codigo = $codigo");
    
    while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
        $imc = $linha["peso"] / ($linha["altura"] * $linha["altura"]);
        echo "<div class='card-body'>";
        echo "<div class='card-header'>Código:".$linha["codigo"]."</div>";
        echo "<h5 class='card-title'>Nome: ".$linha["nome"]."</h5>";
        echo "<p class='card-text'>Peso: ".$linha["peso"]."Kg <br>Altura: ".$linha["altura"]."m<br> IMC: ".round($imc, $precision = 2)."</p>";
        echo "<a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&codigo=".$linha['codigo']."'.>Excluir</a>";
        echo "&nbsp;&nbsp;";
        echo "<a class='btn btn-warning' href='cad.php?acao=editar&codigo=".$linha['codigo']."'.>Editar</a>";
    }
?>  
</div>
</div>
<?php include '../footer.php' ?>