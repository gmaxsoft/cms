<?php

namespace App\Controllers;

use \Core\View;

class UsersController
{
    public function index(): void
    {
        View::renderTemplate('Users/index.html');
    }
}
