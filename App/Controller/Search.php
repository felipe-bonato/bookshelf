<?php namespace App\Controller;


class Search extends \Core\Controller
{
	public function index_action(): void
	{
		\Core\View::render_templeate('search/index.html');
	}

	public function result_action(): void
	{
		\Core\View::render_templeate('search/result.html', [
			'results' => \App\Model\Book::search($_POST['search_string'])
		]);
	}
}

