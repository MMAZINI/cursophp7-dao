<?php

 class Usuario {

 	private $idUsuario;
 	private $loginn;
 	private $senha;
 	private $dataCadastro;

 	public function __construct(){

 	}

 	public function setIdUsuario($valor){
 		$this->idUsuario = $valor;
 	}

 	public function getIdUsuario(){
 		return $this->idUsuario;
 	}

 	public function setLoginn($valor){
 		$this->loginn = $valor;
 	}

 	public function getLoginn(){
 		return $this->loginn;
 	}

 	public function setSenha($valor){
 		$this->senha = $valor;
 	}

 	public function getSenha(){
 		return $this->senha;
 	}

 	public function setDataCadastro($dataCadastro){
 		$this->dataCadastro = $dataCadastro;
 	}

 	public function getDataCadastro(){
 		return $this->dataCadastro;
 	}


 	//metodos

 	public function loadById($id){

 		$sql = new Sql();

 		$results = $sql->select("SELECT * FROM usuario WHERE idUsuario = :id",array(

 				":id"=>$id

 		));

 		if(count($results) > 0){

 			$row = $results[0];

 			$this->setIdUsuario($row['idUsuario']);
 			$this->setLoginn($row['loginn']);
 			$this->setSenha($row['senha']);
 			$this->setDataCadastro(new DateTime($row['dataCadastro']));


 		}
 	}

 	public function __toString(){

 		return json_encode(array(
 			"idUsuario"=>$this->getIdUsuario(),
 			"loginn"=>$this->getLoginn(),
 			"senha"=>$this->getSenha(),
 			"dataCadastro"=>$this->getDataCadastro()->format("d/m/Y H:i:s")


 		));
 	}
 }

?>