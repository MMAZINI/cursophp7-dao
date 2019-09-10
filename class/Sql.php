<?php
//sera criado uma classe chamada Sql que extende da minha classa PDO que ja possui todos os mnetodos(insert,upedate,delete,select..)

class Sql extends PDO{

	private $con;

	public function __construct(){ //toda vez que eu chamar essa classe eu ja realizo a conexão

		$this->con = new PDO ("mysql:host=localhost;dbname=db_php7", "root", "");

	}

	private function setParams($statment, $parameters = array()){// recebo meus parametros da minha function query

		foreach ($parameters as $key => $value) { //  varro esse array (parameters)ou seja para cada (parameto) eu recebo um (valor), como aquele exemplo $nome = :nome;

			$this->setParam($statment,$key, $value);// para cada parametro varrido eu passo para o setParam que ira realizar o bind
		}
	}	

	private function setParam($statment, $key, $value){ // finalmente aqui eu realizo o aligação e mando executar na minha function query

		$statment->bindParam($key, $value);
	}

    //vou receber rawquery(ou seja minah query bruta)e meus params que por ventura poderao ser varios por isso tenho um array
	public function query($rawquery, $params = array()){

		$stm = $this->con->prepare($rawquery);// preparpo minha query

		$this->setParams($stm,$params);// passo minha query e meus parametros

		$stm->execute();//aqui eu executo

		return $stm; // e mando me retornar
			
	}

	

	public function select($rawquery, $params = array()):array
	{

		$stm = $this->query($rawquery, $params);

		return $stm->fetchAll(PDO::FETCH_ASSOC);


	}


}


?>