<?php

declare(strict_types=1);

// error_reporting(0);

use Youtube\Crud\Config\Utils;
use Youtube\Crud\View\Router;

require __DIR__ . "/vendor/autoload.php";

Utils::CORS();

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$router = new Router();
