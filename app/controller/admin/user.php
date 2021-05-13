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
		\Core\View::render_templeate('admin/user/list.html', ['users' => $users]);
	}
}
