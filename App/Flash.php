<?php namespace App;

class Flash
{
	const INFO = 'info'; // Green
	const SUCCESS = 'success'; // Green
	const WARNING = 'warning'; // Green
	const ERROR = 'error'; // Green


	/**
	 * @param string $text The text of the message
	 * @param string $type Type of the message. You should use the Flash's class constants
	 */
	public static function add_message(string $text, string $type): void
	{
		if(!isset($_SESSION['flash_notifications'])){
			$_SESSION['flash_notifications'] = [];
		}

		$_SESSION['flash_notifications'][] = [
			'text' => $text,
			'type' => $type
		];
	}

	/**
	 * @return array|none
	 */
	public static function get_messages()
	{
		if(isset($_SESSION['flash_notifications'])){
			$msgs = $_SESSION['flash_notifications'];
			unset($_SESSION['flash_notifications']);
			return $msgs;
		}
	}
}