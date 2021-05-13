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

	public function sell_action(): void
	{
		$this->require_login();
		
		$book = new \App\Model\Book($_POST);
		\Core\View::render_templeate('book/sell.html', ['book' => $book]);
	}

	public function insert_action(): void
	{
		$book = new \App\Model\Book($_POST);
		
		if(!$book->insert()){
			\Core\View::render_templeate('book/sell.html', [
				'book' => $book
			]);
			return;
		}
		\App\redirect('book/success');
	}

	public function success_action(): void
	{
		\Core\View::render_templeate('book/success.html');
	}
}
