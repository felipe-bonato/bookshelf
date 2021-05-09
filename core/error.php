<?php namespace core;

/**
 * Bookshelf Exception Class
 */
class Error
{
	/*public function __construct(string $msg, int $code=0)
	{
		$cur_time = date('Y-m-d h:i:s u e', mktime());
		$path = date('Ymdhisue', $cur_time).' - '.$code;
		$msg = '['.$cur_time.']['.$code.'] '.$msg;

		if(file_put_contents($path, $msg) == false){
			throw new Exception('Could not creata an exception!');
		}

		parent::__construct($msg, $code, $this);
	}*/

	/**
	 * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
	 *
	 * @param int $level  Error level
	 * @param string $message  Error message
	 * @param string $file  Filename the error was raised in
	 * @param int $line  Line number in the file
	 *
	 * @return void
	 */
	public static function error_handler(int $level, string $message, string $file, int $line): void
	{
		if(error_reporting() !== 0){
			throw new \ErrorException($message, 0, $level, $file, $line);
		}
	}

	/**
	 * @param Throwable $exception 
	 */
	public static function exception_handler(\Throwable $exception): void
	{
		$code = $exception->getCode();
		if($code !== 404){
			$code = 500;
		}

		http_response_code($code);

		$error_msg = '
		<div id="error">
			<h1>Fatal Error</h1>
			<p>Exception <i>"'.get_class($exception).'"</i> was not found</p>
			<p>Message: <i>'.$exception->getMessage().'</i></p>
			<p>Stack Trace: <pre>'.$exception->getTraceAsString().'</pre></p>
			<p>Thrown from <b>'.$exception->getFile().'</b> at line <b>'.$exception->getLine().'</b></p>
		</div>';
		
		include_once('util.php'); // ! THIS NEEDS TO BE FIXED <---------------------------------------------------
		$config = load_config();
		if($config['php']['show_errors']){
			echo $error_msg;
		} else {
			ini_set('error_log', dirname(__DIR__).'/log/'.date('Y-m-d').'.html');
			error_log($error_msg);

			View::render_templeate('error/'.$code.'.html');
		}

		
	}
}