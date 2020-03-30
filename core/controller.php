<?php
require_once "view.php";
require_once "model.php";
class Controller
{
    function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }
}