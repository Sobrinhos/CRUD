<?php

use Youtube\Crud\Entities\Lead;

require __DIR__ . "/vendor/autoload.php";

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

$lead = new Lead("mudou@email.com");
echo "<pre>";
print_r($lead->save());
echo "</pre>";
