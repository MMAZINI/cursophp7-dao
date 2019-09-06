<?php

require_once("config.php");

$sql = new Sql();

$usuarios= $sql->SELECT(" SELECT * FROM usuario");

echo json_encode($usuarios);

?>