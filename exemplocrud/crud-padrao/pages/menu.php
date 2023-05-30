<?php 
    $path = '../conf/conf.inc.php';
    if (file_exists($path))
      include_once($path);
    $path = '../../conf/conf.inc.php';
    if (file_exists($path))
      include_once($path);  
?>

<nav class="navbar" style="background-color: #e3f2fd;">
<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="<?=URL_BASE.'/pages'?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?=URL_BASE.'pages/atleta/'?>">Atleta</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?=URL_BASE.'pages/tipoUsuario/'?>">Tipo Usuário</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?=URL_BASE.'pages/usuario/'?>">Usuário</a>
        </li>
      </ul>
    </div>
  </div>
</nav>