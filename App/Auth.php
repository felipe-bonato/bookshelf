<?php namespace App;

class Auth
{
	public static function login(\App\Model\User $user): void
	{
		session_regenerate_id(true);
		$_SESSION['user_id'] = $user->id;
	}

	public static function logout(): void
	{
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

	public static function get_user()
	{
		if(isset($_SESSION['user_id'])){
			return \App\Model\User::get_user_by_id($_SESSION['user_id']); //? Maybe change this to email?
		}
	}

	public static function set_return_page(): void
	{
		$_SESSION['return_to'] = $_SERVER['REQUEST_URI'];
	}
	
	public static function get_return_page(): string
	{
		return $_SESSION['return_to'] ?? '';
	}
}