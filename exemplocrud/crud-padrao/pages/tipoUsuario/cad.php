<?php 
    include '../header.php'; 
    include 'acao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $dados = array();
    if ($acao == 'editar'){
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';
        $dados = findById($codigo);
        //var_dump($dados);
    }
    
    
?>

<div class="container-fluid">
<br>
<a class='btn btn-secondary'href="index.php">Consultar</a>

<form action="acao.php" method="post">
    <fieldset>
        <legend>Cadastro de Tipo de Usuário</legend>
        <div class="row">
            <div class="col-2">
                <label class="form-label" for="codigo">Código</label>
                <input class="form-control" type="text" name="codigo" id="codigo" readonly
                value="<?php if ($acao == 'editar') echo $dados['codigo']; else echo '0'; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label class="form-label" for="descricao">Descrição</label>
                <input class="form-control" type="text" name="descricao" id="descricao" placeholder="Informe a descrição" required
                value="<?php if ($acao == 'editar') echo $dados['descricao'];?>">
            </div>
        </div>
       
        <br>
        <div class="row">
            <div class="col-2">
                <button class="form-control btn btn-primary" type="submit" 
                    value="salvar" name="acao" id="acao"> 
                    <?php if ($acao == 'editar') echo "Editar"; else echo "Inserir"?>
                </button>
            </div>
        </div>
    </fieldset>
</form>   

</div>

<?php include '../footer.php'; ?>