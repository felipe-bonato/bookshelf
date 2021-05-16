<?php namespace App\Controller;

/**
 * Book controller
 */
class Book extends \Core\Controller
{
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

	public function view_action(int $id): void
	{
		$book = \App\Model\Book::get_book_by_id($id);
		
		if(empty($book)){
			throw new \Exception('Book does not exist', 404);
			return;
		}

		\Core\View::render_templeate('book/view.html', [
			'book' => $book,
			'user' => \App\Auth::get_user()
		]);
	}

	public function edit_action(int $id): void
	{
		$book = \App\Model\Book::get_book_by_id($id);
		
		\Core\View::render_templeate('book/edit.html', [
			'book' => $book
		]);
		
		
		//\App\redirect('book/'.$id.'/success'); // TODO THIS MIGHT NEED TO CHANGE <----------------------------------
	}

	public function modify_action()
	{
		$book = new \App\Model\Book($_POST);

		if($book->modify()){
			\App\Flash::add_message('Your book was modified successfully!', \App\Flash::SUCCESS);
			\App\redirect('book/'.$book->id);
		} else {
			\App\Flash::add_message('Could not modify your book!', \App\Flash::WARNING);
			\Core\View::render_templeate('book/modify.html', [
				'book' => $book
			]);
		}
	}

	public function delete_action(int $id): void
	{
		$book = \App\Model\Book::get_book_by_id($id);
		
		$book->delete();

		\App\Flash::add_message('Your book was deleted successfully!', \App\Flash::SUCCESS);
		\App\redirect('');
	}

	public function success_action(): void
	{
		\Core\View::render_templeate('book/success.html');
	}
}
