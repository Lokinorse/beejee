<?php
class Bootstrap 
{
    function __construct(){
        $url = $_GET['url'];
        $url = explode('/', $url);

        if(in_array('js', $url)){
            exit();
        }

        if ($url[0] == 'index.php'){
            require 'controllers/index.php';
            $controller = new index;
            return false;
        } else {

            $file = 'controllers/' . $url[0] . '.php';
            if(file_exists($file)){
                require $file;
            } else {
                throw new Exception("The file $file does not exists");
            }
            $controller = new $url[0];
            if(!empty($url[2])){

                $controller->{$url[1]}($url[2]);
            } else {
                if(!empty($url[1])){
                $controller->{$url[1]}();
                };
            };
        };
    }
}