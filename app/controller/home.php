<?php namespace app\controller;

require_once '../core/view.php'; // ! FIX THIS, DO I REALLY NEED THIS?

/**
 * Home controller
 */
class Home extends \core\Controller
{
	public function index_action(): void
	{
		\core\View::render('home/index.php', [
			'name' => 'Felipe',
			'languages' => ['C', 'Python', 'PHP']
		]);
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

