<?php
// <exemplo junçao de tabelas - 1 para muitos>
$consulta=$conexao->query("SELECT solicitar.codigo, origem, destino,endereco,data,  usuario.usuario FROM solicitar  LEFT outer JOIN usuario ON usuario.codigo = solicitar.Usuario_codigo   WHERE origem  like '$filtro%';");

// associativa junção usando left join

FROM tabela1
LEFT JOIN tabela_associativa ON tabela1.id = tabela_associativa.id_tabela1
LEFT JOIN tabela2 ON tabela_associativa.id_tabela2 = tabela2.id

?>