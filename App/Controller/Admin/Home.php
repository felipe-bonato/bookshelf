<?php namespace App\Controller\Admin;

/**
 * Home controller
 */
class Home extends \Core\Controller
{
	public function menu_action(): void
	{
		$this->require_admin();

		\Core\View::render_templeate('Admin/menu.html');
	}
}