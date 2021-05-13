<?php namespace App\Controller;

class Register extends \Core\Controller
{
	public function new_action(): void
	{
		\Core\View::render_templeate('register/new.html');
	}

	public function insert_action(): void
	{
		$user = new \App\Model\User($_POST);
		
		if(!$user->insert()){
			\Core\View::render_templeate('register/new.html', [
				'user' => $user
			]);
			return;
		}
		\App\redirect('register/success');
	}

	public function success_action(): void
	{
		\Core\View::render_templeate('register/success.html');
	}
}
