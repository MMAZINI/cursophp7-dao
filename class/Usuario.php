<?php

 class Usuario { // crio um Usuario

 	private $idUsuario;
 	private $loginn;
 	private $senha;
 	private $dataCadastro;
 	//construtor

 	 public function __construct($login ="", $password=""){
 	 	$this->setLoginn($login);
 	 	$this->setSenha($password);

 	 }
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

 			$this->setData($results[0]);

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
    		
    		$this->setData($results[0]);
 
    	}
    	else {

    		throw new Exception("Error logine senha invalidos!");
    		
    	}
    } 

    //criando um metodo para não precisar toda setar os parametos
    public function setData($data){
    	    
    	    $this->setIdUsuario($data['idUsuario']);
    	 	$this->setLoginn($data['loginn']);
    		$this->setSenha($data['senha']);
    		$this->setDataCadastro(new DateTime($data['dataCadastro']));


    }



	// public function insert(){

	// 		$sql = new Sql();
	// 	    //realizaremos com select pois ira executar uma função no meu banco de dados que retornara o ultimo a iD gerado na tabela
	// 	    // procedure
	// 		$results = $sql->select("CALL sp_usuario_insert(:login,:senha)",array(
			
	// 		':login'=>$this->getLoginn(),
	// 		':senha'=>$this->getSenha()

	// 		));

	// 		if(count($results) >0){

	// 			$this->setData($results[0]);
	// 		} 
			
	// 	}

	public function insert(){
		
		$sql = new Sql();

		$results= $sql->query("INSERT INTO usuario (loginn,senha ) VALUES(:login, :senha)",array(
            //aqui eu pego os atributos setados e jogo na minha query para ser alterado
			  ':login'=>$this->getLoginn(),
			  ':senha'=>$this->getSenha()
			  
		));
				
	}


	// public function update($login, $password){
	// 	// jogo isso para dentro dos atributos da minha clase
	// 	$this->setLoginn($login);
	// 	$this->setSenha($password);

	// 	$sql = new Sql();

	// 	$results= $sql->query("UPDATE usuario set loginn = :login, senha = :senha WHERE idUsuario = :id",array(
 //            //aqui eu pego os atributos setados e jogo na minha query para ser alterado
	// 		  ':login'=>$this->getLoginn(),
	// 		  ':senha'=>$this->getSenha(),
	// 		  ':id'=>$this->getIdUsuario()

	// 	));
				
	// }

	public function update(){


		$sql = new Sql();

		$results= $sql->query("UPDATE usuario set loginn = :login, senha = :senha WHERE idUsuario = :id",array(
            //aqui eu pego os atributos setados e jogo na minha query para ser alterado
			  ':login'=>$this->getLoginn(),
			  ':senha'=>$this->getSenha(),
			  ':id'=>$this->getIdUsuario()

		));
				
	}

    public function delete(){

    	$sql = new Sql();
    	
    	$sql->query("DELETE FROM usuario WHERE idUsuario = :id", array(
    			':id'=>$this->getIdUsuario()
    	));
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