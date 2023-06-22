<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function addRoute($method, $path, $callback)
    {
        $this->routes[$method][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->request->getPath(); //URL del sito
        $method = $this->request->method(); //Get o Post
        $callback = $this->routes[$method][$path] ?? false; //Funzione da eseguire
        if (!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
        }
        return call_user_func($callback, $this->request);
    }
    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    protected function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            // L'istruzione $$key = $value; crea una variabile dinamica
            // con il nome corrispondente alla chiave e assegna ad essa il valore corrispondente.
            // Quindi, se ad esempio l'array $params contiene le coppie 
            // ['nome' => 'John', 'età' => 25], dopo l'esecuzione di 
            // questa istruzione avrai le seguenti variabili disponibili:
            // $nome con il valore 'John'
            // $età con il valore 25
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
