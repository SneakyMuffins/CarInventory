<?php
require_once 'vendor/autoload.php';

use CarInventory\controller\CarController;

$router = new AltoRouter();

$router->map('GET', '/cars', 'CarController#index');
$router->map('GET', '/cars/sort/[a:sortBy]', 'CarController#sort');

$match = $router->match();

if ($match) {
    list($controller, $action) = explode('#', $match['target']);

    $controller = new CarController();
    $controller->$action($match['params']);
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Not Found';
}
