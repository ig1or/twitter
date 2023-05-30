<?php $path = '../conf/conf.inc.php';
    if (file_exists($path))
      include_once($path);
    $path = '../../conf/conf.inc.php';
    if (file_exists($path))
      include_once($path);  
?>
<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Padrão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=URL_BASE.'/assets/css/estilo.css'?>">
    <script src="<?=URL_BASE.'/assets/js/script.js'?>"></script>
  </head>
  <body>
  <?php include 'menu.php' ?>