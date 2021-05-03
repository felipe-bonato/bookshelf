<?php namespace app\controller;

/**
 * Book controller
 */
class Book extends \core\Controller
{
	public function index_action(): void
	{
		echo 'Hello, i\'m inside the index method in the book controller';
	}

	public function edit_action(): void
	{
		echo 'Hello, i\'m inside the teste_de_caminho method in the bookz controller yo';
	}

	protected function before(): bool
	{
		// TODO: add checks
		echo 'Before';
		return true;
	}

	protected function after(): void
	{
		echo 'After';
	}
}