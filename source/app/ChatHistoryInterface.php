<?php

namespace Achat;

interface ChatHistoryInterface
{
	public function addMessage($message);
	public function findRecent();
	public function findSinceId($id);
}

