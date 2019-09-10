<?php

 class Usuario { // crio um Usuario

 	private $idUsuario;
 	private $loginn;
 	private $senha;
 	private $dataCadastro;
 	//construtor

 	// public function __construct(){

 	// }
	//get e set
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

 	public function setDataCadastro($valor){
 		$this->dataCadastro = $valor;
 	}

 	public function getDataCadastro(){
 		return $this->dataCadastro;
 	}


 	//metodos

 	//buscando pelo Id

 	public function loadById($id){

 		$sql = new Sql(); //instacio meu sql  que ira buscarno banco meu usuario que eu quizer 

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

 	// buscar todos

 	public static function loadAll(){ // a vantagwm do meu metodo ser estatico é que eu não preciso instancia esse

 		$sql = new Sql();
 		$results = $sql -> select("SELECT * FROM usuario order by loginn;");
 		return $results;
 	}

 	// buscar por nome

 	public static function loadSearch($login){
 		$sql = new Sql();
 		$results = $sql-> select("SELECT * FROM usuario where loginn like :search order by loginn", array(
 				":search"=>"%".$login."%"
 		));

 		return $results;
 	}

    //validação de Usuario(login e senha)

    public function validaUser($login, $senha){

    	$sql = new Sql();

    	$results= $sql->select("SELECT * FROM usuario where loginn = :login and senha = :senha",array(
         
         ":login"=>$login,
         ":senha"=>$senha
    	));

    	if(count($results)>0){
    		$row = $results[0];

    		$this->setIdUsuario($row['idUsuario']);
    		$this->setLoginn($row['loginn']);
    		$this->setSenha($row['senha']);
    		$this->setDataCadastro(new DateTime($row['dataCadastro']));
    	}
    	else {

    		throw new Exception("Error logine senha invalidos!");
    		
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