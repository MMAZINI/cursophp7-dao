<?php

require_once("config.php");

// $sql = new Sql();

// $usuarios= $sql->SELECT(" SELECT * FROM usuario");

// echo json_encode($usuarios);

//buscando Usuario pelo id
// $usuario = new Usuario();
// $usuario->loadById(1);
// echo $usuario;

//buscando todos os Usuarios
// $lista = Usuario::loadAll();
// echo json_encode($lista);


// buscando por Nome
// $search= Usuario::loadSearch("iran");
// echo json_encode($search);

//validando Login
// $validar = new Usuario();
// $validar -> validaUser("marcos","123");
//  echo $validar;

//inserir um usuario novo e trazendo ele do banco 
// $pessoa = new Usuario();
// $pessoa->setLoginn("ronildo");
// $pessoa->setSenha("@ronildo");
// $pessoa->insert();
// echo $pessoa;

//alterar um Usuario
// $pessoa = new Usuario();
// $pessoa->loadById(2);
// $pessoa->update("algelino"," @algelino");
// echo $pessoa;

//alterar um Usuario
$pessoa = new Usuario();
$pessoa->loadById(2);
$pessoa->setLoginn("renata");
$pessoa->setSenha("@renata");
$pessoa->update();
echo $pessoa;



?>