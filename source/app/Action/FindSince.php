<?php

namespace Achat\Action;

class FindSince
{
	public function run($id)
	{
		$connection = new \Achat\PdoConnection();
		$history = new \Achat\ChatHistory($connection);

		$renderer = new \Achat\Renderer\Json();

		return $renderer->render(array(
			"success" => true,
			"entries" => $history->findSinceId($id),
		));
	}
}

