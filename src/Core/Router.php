<?php
class Router {
    private static array $routes = [];

    public static function get(string $path, callable $handler): void {
        self::$routes['GET'][$path] = $handler;
    }

    public static function post(string $path, callable $handler): void {
        self::$routes['POST'][$path] = $handler;
    }

    public static function put(string $path, callable $handler): void {
        self::$routes['PUT'][$path] = $handler;
    }

    public static function delete(string $path, callable $handler): void {
        self::$routes['DELETE'][$path] = $handler;
    }

    public static function dispatch(): void {

        $m = Request::method();
        $u = Request::uri();

        $handler = self::$routes[$m][$u] ?? null;

        if($handler !== null) {
            $handler();
            return;
        }

        $allowed = [];
        foreach(self::$routes as $m => $paths) {
            if(isset($paths[$uri])) {
                $allowed[] = $m;
            }
        }

        if(!empty($allowed)) {
            header('Allow: ' . implode(', ', $allowed));
            Response::json([
                'error' => 'Method not allowed'
            ], 405);
        }

        Response::json([
            'error' => 'Route not found'
        ], 404);
    }
}
