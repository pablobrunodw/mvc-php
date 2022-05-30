<?php 

class View
{
    public function __construct() {
        
    }

    public function render($nombre,$data = [])
    {
        $this->d = $data;
        require_once 'views/' . $nombre . '.php';
    }
}
