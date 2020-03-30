<?php
require_once './core/controller.php';

class Tasks extends Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrPost()
    {
        $this->model->xhrPost();

    }

    function xhrGetTasks($offset=1)
    {
        $this->model->xhrGetTasks($offset);
    }

    function xhrDeleteTasks(){
        $this->model->xhrDeleteTasks();
    }
}