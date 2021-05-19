<?php namespace App\Controller\Admin;

class User extends \Core\Controller
{
	protected function before(): void
	{
		$this->require_admin();
	}

	public function list_action(): void
	{
		$users = \App\Model\User::get_all();
		$deleted_users = \App\Model\User::get_all_deleted();
		\Core\View::render_templeate('admin/user/list.html', [
			'users' => $users,
			'deleted_users' => $deleted_users
		]);
	}

	public function search_action(): void
	{
		\Core\View::render_templeate('admin/user/search.html');
	}

	public function result_action(): void
	{
		\Core\View::render_templeate('admin/user/result.html', [
			'results' => \App\Model\User::search($_POST['search_string'])
		]);
	}
}
