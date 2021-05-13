<?php namespace App\Controller;

class Profile extends \Core\Controller
{
	protected function before(): void {
		$this->require_login();
	}

	public function index_action()
	{
		\Core\View::render_templeate('profile/index.html', [
			'user' => \App\Auth::get_user()
		]);
	}

	public function modify_action()
	{
		$user = new \App\Model\User($_POST);

		if($user->modify()){
			\App\Flash::add_message('Your profile was modified successfully!', \App\Flash::SUCCESS);
			\Core\redirect('/profile/index');
		} else {
			\Core\View::render_templeate('profile/index.html', [
				'user' => $user
			]);	
		}
	}
}