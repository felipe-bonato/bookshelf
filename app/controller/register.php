<?php namespace app\controller;

class Register extends \core\Controller
{
	public function new_action(): void
	{
		\core\View::render_templeate('register/new.html');
	}

	public function insert_action(): void
	{
		$user = new \app\model\User($_POST);
		
		if(!$user->insert()){
			\core\View::render_templeate('register/new.html', [
				'user' => $user
			]);
			return;
		}
		include_once('../util.php');
		\core\redirect('register/success.html');
	}

	public function success_action(): void
	{
		\core\View::render_templeate('register/success.html');
	}
}