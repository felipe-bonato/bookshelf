<?php namespace App\Controller;

class Login extends \Core\Controller
{
	public function index_action(): void
	{
		\Core\View::render_templeate('login/index.html');
	}

	public function validate_action(): void
	{
		$user = \App\Model\User::authenticate($_POST['email'], $_POST['password']);

		if($user){
			\Core\redirect('');
			exit;
		} else {
			\Core\View::render_templeate('login/index.html', [
				'email' => $_POST['email']
			]);
		}
	}
}