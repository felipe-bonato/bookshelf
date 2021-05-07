<?php namespace core;

/**
 * Renderer
 */
class View
{
	/**
	 * Render the view file
	 * @param string $view View file
	 * @param array $args All variables that will be accessed in the view
	 * @return void
	 */
	public static function render(string $view, array $args=[]): void
	{
		extract($args, EXTR_SKIP);

		$file = '../app/view/'.$view;

		if(iS_readable($file)){
			require $file;
		} else {
			echo 'ERROR: FILE'.$file.' NOT FOUND'; //TODO FIX THIS
		}
	}

	public static function render_templeate(string $template, array $args=[]): void
	{
		static $twig = null;

		if($twig === null){
			$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/app/view');
			$twig = new \Twig\Environment($loader);
		}

		echo $twig->render($template, $args);
	}
}
