<?php


namespace Backend\Router;
use Backend\Controller\UserController;

class Router{

    private static $routes = [];

    public static function get($url, $callback) {
        self::$routes['GET'][$url] = $callback;
    }

    // İstekleri işleyen metod
    public static function dispatch() {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Tanımlı route'ları kontrol et
        if (isset(self::$routes[$requestMethod][$requestUrl])) {
            // Eşleşen route için callback fonksiyonu çalıştır
            $callback = self::$routes[$requestMethod][$requestUrl];
            echo call_user_func($callback);
        } else {
            // Eşleşen route bulunamazsa 404 sayfası döndür
            http_response_code(404);
            echo "404 Not Found";
        }
    }

}