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
			\App\redirect('profile/index');
		} else {
			\App\Flash::add_message('Could not modify your profile!', \App\Flash::WARNING);
			\Core\View::render_templeate('profile/index.html', [
				'user' => $user
			]);	
		}
	}

	public function delete_action(){
		$user = \App\Auth::get_user();

		\App\put("aee");
		$user->delete();

		\App\redirect('');
	}

	public function view(int $id): void
	{
		$this->require_admin();

		\Core\View::render_templeate('profile/index.html', [
			'user' => \App\Model\User::get_user_by_id($id)
		]);
	}
}