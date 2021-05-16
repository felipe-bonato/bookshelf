<?php namespace App\Controller;

/**
 * Home controller
 */
class Home extends \Core\Controller
{
	public function index_action(): void
	{
		$books = \App\Model\Book::get_all();
		shuffle($books);

		\Core\View::render_templeate('home/index.html', [
			'books' => $books
		]);
	}
}

