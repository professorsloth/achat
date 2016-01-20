<?php

namespace Achat\Action;

class FindRecent
{
	public function run()
	{
		$connection = new \Achat\PdoConnection();
		$history = new \Achat\ChatHistory($connection);

		$renderer = new \Achat\Renderer\Json();

		return $renderer->render(array(
			"success" => true,
			"entries" => $history->findRecent(),
		));
	}
}

