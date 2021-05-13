<?php namespace App\Controller\Admin;

class User extends \Core\Controller
{
	public function list_action(): void
	{
		$books = \App\Model\Book::get_all();
		\Core\View::render_templeate('admin/book/list.html', ['books' => $books]);
	}
}
