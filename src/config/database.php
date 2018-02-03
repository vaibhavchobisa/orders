<?php

class database {

	//Properties

	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'orders';

	//Connection

	public function connect(){
		$connect = "mysql:host=$this->dbhost; dbname=$this->dbname";
		$dbConnection = new PDO($connect, $this->dbuser, $this->dbpass);

		$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $dbConnection;
	}
}