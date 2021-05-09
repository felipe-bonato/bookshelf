<?php namespace App\Controller;

/**
 * Book controller
 */
class Book extends \Core\Controller
{
	public function index_action(): void
	{
		$books = \App\Model\Book::get_all();
		\Core\View::render_templeate('book/index.html', ['books' => $books]);
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
