<?php namespace App\Controller\Admin;

class User extends \Core\Controller
{
	public function index_action(): void
	{
		echo 'Hello, i\'m inside the index method in the admin controller';
	}

	protected function before(): bool
	{
        // TODO: Test if admin is logged
		echo 'Before in admin';
        return true;
	}

	protected function after(): void
	{
		echo 'After in admin';
	}    
}
