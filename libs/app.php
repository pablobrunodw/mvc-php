<?php 

class App
{
    public function __construct() {
        $url = (isset($_GET['url'])) ? $_GET['url'] : 'login' ;
        $url = rtrim($url,"/");
        $url = explode("/",$url);
        
        $controlador = $url[0];
        $metodo = (isset($url[1])) ? $url[1] : null;
        $parametros = (isset($url[2])) ? array_slice($url,2) : null;
        
        $controllerFile = 'controllers/' . $controlador . '_controller.php';
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controller = new $controlador;
            $controller->loadModel($controlador);
            if (!is_null($metodo)) {
                if(method_exists($controller,$metodo)){
                    if (!is_null($parametros)) {
                        $controller->{$metodo}($parametros);
                    } else {
                        $controller->{$metodo}();
                    }
                } else {
                    require_once 'controllers/errores_controller.php';
                    $controller = new Errores;
                    error_log($controlador . '::' . $metodo . ' desconocido');
                    $controller->render();
                }
            } else {
                $controller->render();
            }
        } else {
            require_once 'controllers/errores_controller.php';
            $controller = new Errores;
            error_log( 'Controlador ' . $controlador . 'Desconocido');
            $controller->render();
        }
    }

}
