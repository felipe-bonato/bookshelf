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
			var_dump($user->errors); // TODO: is this really a vardump?
			return;
		}

		\core\View::render_templeate('register/success.html');
	}
}