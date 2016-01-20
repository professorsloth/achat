<?php

namespace Achat\Renderer;

class Twig
{
	public function render($templateName)
	{
		$loader = new \Twig_Loader_Filesystem("../source/app/templates/");
		$twig = new \Twig_Environment($loader, array());

		$template = $twig->loadTemplate("$templateName.html");

		return $template->render(array());
	}
}
