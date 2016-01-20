<?php

namespace Achat;

class ChatHistory implements \Achat\ChatHistoryInterface
{
	protected $_connection = null;

	public function __construct($connection)
	{
		$this->_connection = $connection->getConnection();
	}

	public function findRecent()
	{
		$statement = $this->_connection->prepare("SELECT `id`, `message` FROM `chat_history` ORDER BY `date_created` DESC LIMIT 10");
		$statement->execute();

		$result = array();

		while ($item = $statement->fetch(\PDO::FETCH_OBJ)) {
			$result[$item->id] = $item->message;
		}

		return $result;
	}

	public function findSinceId($id)
	{
		$statement = $this->_connection->prepare("SELECT `id`, `message` FROM `chat_history` WHERE `id` > :id ORDER BY `date_created` DESC");
		$statement->bindValue(":id", $id, \PDO::PARAM_INT);
		$statement->execute();

		$result = array();

		while ($item = $statement->fetch(\PDO::FETCH_OBJ)) {
			$result[$item->id] = $item->message;
		}

		return $result;
	}

	public function addMessage($message)
	{
		$statement = $this->_connection->prepare("INSERT INTO `chat_history` (`message`, `date_created`) VALUES (:message, NOW())");
		$statement->bindValue(":message", $message, \PDO::PARAM_STR);
		$result = $statement->execute();

		return $result;
	}
}

