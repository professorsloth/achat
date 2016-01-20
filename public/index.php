<?php

require "../source/vendor/autoload.php";

switch ($_SERVER["REQUEST_URI"]) {
	case "/":
		$action = new Achat\Action\Home();
		echo $action->run();
		break;

	case "/add":
		$message = $_POST["message"];
		$action = new Achat\Action\AddMessage();
		echo $action->run($message);
		break;

	case "/since":
		$id = $_POST["most_recent_id"];
		$action = new Achat\Action\FindSince();
		echo $action->run($id);
		break;

	case "/recent":
		$action = new Achat\Action\FindRecent();
		echo $action->run();
		break;

	default:
		header("Content-Type: text/plain");
		http_response_code(404);
		echo "404";
}


