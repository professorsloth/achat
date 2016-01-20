<?php

namespace Achat;

class PdoConnection
{
	protected $_pdo = null;

	public function __construct()
	{
		$this->_pdo = new \PDO("mysql:host=192.168.1.250;dbname=achat;charset=utf8", "achat", "password");
		$this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public function getConnection()
	{
		return $this->_pdo;
	}
}

