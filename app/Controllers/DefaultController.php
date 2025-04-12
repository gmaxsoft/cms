<?php

namespace App\Controllers;

use \Core\View;

class DefaultController
{
	public function notFound(): void
	{
		View::renderTemplate('404.html');
	}

	public function error500(): void
	{
		View::renderTemplate('500.html');
	}
}