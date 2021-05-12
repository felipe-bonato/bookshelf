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
			
			$_SESSION['user_nickname'] = $user->nickname;
			$_SESSION['user_email'] = $user->email;

			\Core\redirect('');
			exit;
		} else {
			\Core\View::render_templeate('access/login.html', [
				'email' => $_POST['email']
			]);
		}
	}

	public function logout_action(): void
	{
		if($_SESSION){
			$_SESSION = array(); // Unset all session variables
		
			if(ini_get('session.use_cookies')){ // Delete the cookies
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params['path'], $params['domain'],
					$params['secure'], $params['httponly']
				);
			}

			session_destroy(); // Delete the session
		}

		\Core\redirect('');
	}
}