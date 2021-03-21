<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controller\MainController;

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '/game-log' :
        echo json_encode((new MainController())->index());
        break;
    default:
        http_response_code(404);
        break;
}
?>

