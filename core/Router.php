<?php
/**
 * core/Router.php
 * Router SEDERHANA buatan sendiri — inti dari "routing sendiri".
 *
 * Cara kerja singkat:
 *  - $router->get('/guru', ['GuruController', 'index']) artinya:
 *      kalau ada request GET ke "/guru", jalankan method index()
 *      di dalam class GuruController.
 *  - Mendukung parameter dinamis, contoh: '/guru/edit/{id}'
 *      -> {id} akan otomatis dikirim sebagai argumen ke method controller.
 */

class Router
{
    /** @var array Daftar semua route yang terdaftar, dikelompokkan per HTTP method */
    protected array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    public function get(string $uri, array $action): void
    {
        $this->routes['GET'][$this->normalize($uri)] = $action;
    }

    public function post(string $uri, array $action): void
    {
        $this->routes['POST'][$this->normalize($uri)] = $action;
    }

    /** Merapikan URI supaya format-nya konsisten, contoh: "guru/" -> "/guru" */
    protected function normalize(string $uri): string
    {
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    /**
     * Menjalankan route yang cocok dengan request saat ini.
     */
    public function dispatch(string $method, string $requestUri): void
    {
        // Buang query string (misal ?foo=bar) dan ambil path saja
        $path = parse_url($requestUri, PHP_URL_PATH);
        $path = $this->normalize($path);

        $routesForMethod = $this->routes[$method] ?? [];

        foreach ($routesForMethod as $pattern => $action) {
            // Ubah pattern seperti "/guru/edit/{id}" menjadi regex
            $regex = preg_replace('#\{[a-zA-Z_]+\}#', '([^/]+)', $pattern);
            $regex = '#^' . $regex . '$#';

            if (preg_match($regex, $path, $matches)) {
                array_shift($matches); // buang hasil full-match, sisakan parameter saja

                [$controllerName, $methodName] = $action;
                $this->callController($controllerName, $methodName, $matches);
                return;
            }
        }

        // Tidak ada route yang cocok -> 404
        $this->notFound();
    }

    protected function callController(string $controllerName, string $methodName, array $params): void
    {
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->notFound();
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->notFound();
            return;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            $this->notFound();
            return;
        }

        call_user_func_array([$controller, $methodName], $params);
    }

    protected function notFound(): void
    {
        http_response_code(404);
        require __DIR__ . '/../views/errors/404.php';
    }
}
