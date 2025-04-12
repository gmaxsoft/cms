<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => $_ENV["DB_DRIVER"],
            'host' => $_ENV["DB_HOST"],
            'database' => $_ENV["DB_NAME"],
            'username' => $_ENV["DB_USER"],
            'password' => $_ENV["DB_PASS"],
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => 'cms_',
        ]);
        $capsule->setAsGlobal(); //set as global
        $capsule->bootEloquent();
    }
}
