<?php

namespace Achat\Action;

class Home
{
	public function run()
	{
		$renderer = new \Achat\Renderer\Twig();

		return $renderer->render("base");
	}
}
