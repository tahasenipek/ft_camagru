<?php

require_once __DIR__ . '/Router/Router.php';

$requestedUrl = $_SERVER['REQUEST_URI'];

$requestedUrl = trim($requestedUrl, '/');



if ($requestedUrl === '') {
    $requestedUrl = 'index.html'; // Varsayılan ana sayfa
} else {
    $requestedUrl .= '.html';
}


$filePath = __DIR__ . "/View/$requestedUrl";


if (file_exists($filePath)) {
    include $filePath;
} else {
    http_response_code(404);
    echo "404 Not Found";
}