<?php namespace App\Controller;

/**
 * Home controller
 */
class Home extends \Core\Controller
{
	public function index_action(): void
	{
		\Core\View::render_templeate('home/index.html', [
			'name' => 'Felipe',
			'languages' => ['C', 'Python', 'PHP']
		]);
	}

	protected function before(): bool
	{
		// TODO: add checks
		//echo 'Before';
		return true;
	}

	protected function after(): void
	{
		//echo 'After';
	}
}

