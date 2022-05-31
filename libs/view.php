<?php 

class View
{
    public function __construct() {
        
    }

    public function render($nombre,$data = [])
    {
        $this->d = $data;
        $this->handleMessage();
        require_once 'views/' . $nombre . '.php';
    }

    private function handleMessage()
    {
        if (isset($_GET['error']) && isset($_GET['success'])) {
            error_log('VIEW::handleMessage => Se recibió mensaje de error y éxito conjuntamente');
        } else if (isset($_GET['error'])) {
            $this->handleError();
        } else if (isset($_GET['success'])) {
            $this->handleSuccess();
        }
    }

    private function handleError()
    {
        $hash = $_GET['error'];
        $error = new Errors();

        if ($error->existsKey($hash)) {
            $this->d['error'] = $error->get($hash);
        }
    }

    private function handleSuccess()
    {
        $hash = $_GET['success'];
        $success = new Success();

        if ($success->existsKey($hash)) {
            $this->s['success'] = $success->get($hash);
        }
    }

    private function showErrors()
    {
        if (array_key_exists('erros',$this->d)) {
            echo '<div class="error">'.$this->d['error'].'</div>';
        }
    }
    
    private function showSuccess()
    {
        if (array_key_exists('success',$this->d)) {
            echo '<div class="success">'.$this->d['success'].'</div>';
        }
    }

    public function showMessages()
    {
        $this->showErrors();
        $this->showSuccess();
    }
}
