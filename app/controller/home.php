<?php namespace app\controller;



/**
 * Home controller
 */
class Home extends \core\Controller
{
	public function index_action(): void
	{
		\core\View::render_templeate('home/index.html', [
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

