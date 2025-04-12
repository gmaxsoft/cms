<?php

namespace Core;

use Core\Messages;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use voku\helper\HtmlMin;
use voku\twig\MinifyHtmlExtension;
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\AuthController;

/**
 * View
 *
 */
class View
{
	/**
	 * Render a view file
	 * @param string $view The view file
	 * @param array $args Associative array of data to display in the view (optional)
	 * @return void
	 */
	public static function render($view, $args = [])
	{
		extract($args, EXTR_SKIP);
		$file = dirname(__DIR__) . "/app/Views/$view";  // relative to Core directory
		if (is_readable($file)) {
			require $file;
		} else {
			throw new \Exception("$file not found in Views folder");
		}
	}
	/**
	 * Render a view template using Twig
	 * @param string $template The template file
	 * @param array $args Associative array of data to display in the view (optional)
	 * @return void
	 */

	public static function redirect($url)
	{
		header('Location: http://' . $_SERVER['HTTP_HOST'] . $url, true, 303);
		exit();
	}

	public static function renderTemplate($template, $args = [])
	{
		static $twig = null;
		if ($twig === null) {

			$csrf_token = SimpleRouter::router()->getCsrfVerifier()->getTokenProvider()->getToken();
			$loader = new FilesystemLoader(dirname(__DIR__) . '/app/Views');
			$twig = new Environment($loader);

			// Kompresja HTML
			$minifier = new HtmlMin();
			$twig->addExtension(new MinifyHtmlExtension($minifier));
			$twig->addGlobal('userinfo', $_SESSION['userinfo'] ?? null);
			$twig->addGlobal('frontend_url', $_ENV['FRONTEND_URL']);
			$twig->addGlobal('csrf_token', $csrf_token);
			$twig->addGlobal('isLoggedIn', AuthController::isLoggedIn());
			$twig->addGlobal('messages', Messages::getMessages());
			//$twig->addGlobal('currentUser', \App\Controllers\AuthController::getUser());
		}
		echo $twig->render($template, $args);
	}
}
