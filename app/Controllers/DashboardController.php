<?php

namespace App\Controllers;

use \Core\View;
use \App\Controllers\AuthController;

/**
 * Dashboard Controller
 *
 */
class DashboardController
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function index(): void
    {
        if (AuthController::isLoggedIn() === false) {
            View::renderTemplate('Home/index.html');
        } else {
            View::renderTemplate('Dashboard/index.html');
        }
    }
}
