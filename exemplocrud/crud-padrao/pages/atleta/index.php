<?php 
    require_once "../../conf/Conexao.php";
    include '../header.php'; 
    ?>
  
    <div class="container-fluid">
    <br>
    <a class='btn btn-secondary'href="cad.php">Cadastrar</a>
    <br><br>
    <form action="" method="get">
        <fieldset>
        <legend>Consulta de Atleta</legend>

        <div class="row align-items-end">
            <div class="col-3">
                
                <input class="form-control" type="text" name="filtro" id="filtro">
            </div>
            <div class="col-1">
            <button type="submit" class="btn btn-success">Consultar</button>

            </div>
        </div>
        </fieldset>
    </form>

    <br>
    <table class="table table-striped">
    <thead>
        <tr class='table-titulo'>
            <th>Código</th>
            <th>Nome</th>
            <th>Peso (kg)</th> 
            <th>Altura (m)</th>
            <th>IMC</th>   
            <th>Detalhes</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
<?php
    $conexao = Conexao::getInstance();

    $filtro = isset($_GET['filtro']) ? $_GET['filtro']: "";
    $consulta=$conexao->query("SELECT * FROM atleta where nome like '$filtro%';");
    
    while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
        $conta = $linha["peso"] / ($linha["altura"] * $linha["altura"]);
        if($conta > 35){
            echo "<tr>
                   <td>{$linha['codigo']}</td>
                   <td>{$linha['nome']}</td>
                   <td>{$linha['peso']}</td>
                   <td>{$linha['altura']}</td>
                   <td style='color:red'>".round($conta, $precision = 2)."</td>
                   <td><a class='btn btn-info' href='show.php?codigo={$linha['codigo']}'>Detalhes</a></td>
                   <td><a class='btn btn-warning' href='cad.php?acao=editar&codigo={$linha['codigo']}'>Editar</a></td>
                   <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&codigo={$linha['codigo']}'.>Excluir</a></td>
                  </tr>\n";
        }else{
            echo "<tr>
                    <td>{$linha['codigo']}</td>
                    <td>{$linha['nome']}</td>
                    <td>{$linha['peso']}</td>
                    <td>{$linha['altura']}</td>
                    <td>".round($conta, $precision = 2)."</td>
                    <td><a class='btn btn-info' href='show.php?codigo={$linha['codigo']}'>Detalhes</a></td>
                    <td><a class='btn btn-warning' href='cad.php?acao=editar&codigo={$linha['codigo']}'>Editar</a></td>
                    <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&codigo={$linha['codigo']}'.>Excluir</a></td>
                  </tr>\n";
        }
    }
?>
</tbody>
</table>
</div>
<?php include '../footer.php'; ?>