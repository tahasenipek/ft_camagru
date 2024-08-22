<?php

require_once __DIR__ . '/Database/Database.php';
require_once __DIR__ . '/Router/Router.php';


use Backend\Router\Router;
use Backend\Database\Database;

try {
    $db = new Database();

} catch (\PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}



Router::get('/' , function(){
    $filePath = __DIR__ . '/View/index.html'; 

    if (file_exists($filePath)) {
        readfile($filePath);
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
});


Router::dispatch();



?>




