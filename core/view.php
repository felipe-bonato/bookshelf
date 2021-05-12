<?php namespace Core;

/**
 * Renderer
 */
class View
{
	/**
	 * Render the templeate file
	 * @param string $template Templeate file
	 * @param array $args All variables that will be accessed in the view
	 * @return void
	 */
	public static function render_templeate(string $template, array $args=[]): void
	{
		static $twig = null;

		if($twig === null){
			$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__).'/app/view');
			$twig = new \Twig\Environment($loader);
			$twig->addGlobal('session', $_SESSION);
		}

		echo $twig->render($template, $args);
	}
}
