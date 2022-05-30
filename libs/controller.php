<?php 
class Controller
{
    public function __construct() {
        $this->view = new View();
    }

    public function loadModel($model){
        $url = 'models/' . $model . '_model.php';
        if (file_exists($url)) {
            require_once $url;
            $modelName = $model . 'Model';
            $this->model = new $modelName;
        }
    }

    public function existPOST($params)
    {
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                error_log('Controller::existPOST->No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }

    public function existGET($params)
    {
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                error_log('Controller::existGET->No existe el parametro ' . $param);
                return false;
            }
        }
        return true;
    }

    public function getGET($val)
    {
        return $_GET[$val];
    }

    public function getPOST($val)
    {
        return $_POST[$val];
    }

    public function redirect($url,$mensajes)
    {
        
    }
}
