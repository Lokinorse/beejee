<?php
require_once './core/controller.php';
require_once './core/model.php';
require_once './models/admin_model.php';

class Incorrect_Credentials extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->view->render('incorrect_credentials');
        $this->admin_model = new Admin_Model();
/*         $model = new Admin_Model(); */

    }
    public function login($arg=null)
    {
        $this->admin_model->login();
    }
};