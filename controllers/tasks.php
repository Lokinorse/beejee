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

    function xhrGetTasks($offset=1, $sort=555)
    {
        $this->model->xhrGetTasks($offset, $sort);
    }

    function xhrDeleteTasks()
    {
        $this->model->xhrDeleteTasks();
    }

    function UpdateStatus(){
        $this->model->UpdateStatus();
    }
    function EditTask(){
        $this->model->EditTask();
    }
}