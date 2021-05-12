<?php namespace App\Controller;

/**
 * Controls all login and logout
 */
class Access extends \Core\Controller
{
	public function login_action(): void
	{
		\Core\View::render_templeate('access/login.html');
	}

	/**
	 * Validates login form
	 */
	public function validate_action(): void
	{
		$user = \App\Model\User::authenticate($_POST['email'], $_POST['password']);

		if($user){
			\App\Auth::login($user);

			\App\Flash::add_message('You are now logged in!', \App\Flash::SUCCESS);

			\Core\redirect('');
			exit;
		} else { //TODO: WHEN USER CANNOT LOGIN HE IS REDIRECTED TO ACCESS/VALIDE
			\App\Flash::add_message('Could not login; your email and/or password may be wrong!', \App\Flash::WARNING);

			\Core\View::render_templeate('access/login.html', [
				'email' => $_POST['email']
			]);
		}
	}

	public function logout_action(): void
	{
		\App\Auth::logout();
		
		\Core\redirect('/access/show-logout-message');
	}

	public function show_logout_message(): void
	{
		\App\Flash::add_message('You are logged out!', \App\Flash::SUCCESS);
		\Core\redirect('');
	}
}