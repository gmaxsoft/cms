<?php
require dirname(__DIR__)  . '/vendor/autoload.php';
require dirname(__DIR__)  . '/app/helpers.php';
require dirname(__DIR__)  . '/config/routes.php';

set_error_handler('Core\ErrorHandler::handleError', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
set_exception_handler('Core\ErrorHandler::handleException');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Start session
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::enableMultiRouteRendering(false);
// Start the routing
echo SimpleRouter::start();

//var_dump($_SESSION);