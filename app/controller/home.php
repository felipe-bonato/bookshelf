<?php namespace app\controller;

/**
 * Home controller
 */
class Home extends \core\Controller
{
	public function index_action(): void
	{
		echo 'Hello, i\'m inside the index method in the home controller';
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

