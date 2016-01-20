<?php

namespace Achat\Action;

class AddMessage
{
	public function run($message)
	{
		$connection = new \Achat\PdoConnection();
		$history = new \Achat\ChatHistory($connection);

		$result = $history->addMessage($message);

		$renderer = new \Achat\Renderer\Json();

		return $renderer->render(array(
			"success" => (bool)$result,
		));
	}
}

