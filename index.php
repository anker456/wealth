<?php
ini_set("display_errors", On);
ini_set("error_reporting", E_ALL);
require_once __DIR__. "/vendor/autoload.php";
use \NoahBuscher\Macaw\Macaw;
use \Anker456\PDO\Model;
Model::config(require_once __DIR__. '/config/db.php');
// Macaw::get('/', function() {
//     echo 'Welcome to Bee!';
// });

//用户的增删改查
Macaw::get("/users", 'Anker456\Controllers\Users@index');
Macaw::post("/users", 'Anker456\Controllers\Users@store');
Macaw::get("/users/(:num)", 'Anker456\Controllers\Users@show');
Macaw::put("/users", 'Anker456\Controllers\Users@update');
Macaw::delete("/users/(:num)", 'Anker456\Controllers\Users@destroy');
Macaw::dispatch();