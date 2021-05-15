<?php namespace App\Controller\Admin;

class Book extends \Core\Controller
{
	protected function before(): void
	{
		$this->require_admin();
	}

	public function list_action(): void
	{
		$books = \App\Model\Book::get_all();
		$deleted_books = \App\Model\Book::get_all_deleted();
		\Core\View::render_templeate('admin/book/list.html', [
			'books' => $books,
			'deleted_books' => $deleted_books
		]);
	}
}
