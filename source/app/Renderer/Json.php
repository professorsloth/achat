<?php

namespace Achat\Renderer;

class Json
{
	public function render($payload)
	{
		header("Content-Type: application/json");

		$jsonString = json_encode($payload);

		return $jsonString;
	}
}
