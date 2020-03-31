<?php
require_once './core/controller.php';
require_once './core/model.php';
require_once './models/admin_model.php';
require_once './core/session.php';


class Admin_Logged extends Controller
{   
    function __construct()
    {    
        parent::__construct();
        Session::init();
        $logged = Session::get('admin_logged');
        if ($logged == false) {
            Session::destroy ();
            header('location: /admin');
            exit;
        }
        $this->view->render('admin_logged');

    }
    function logout (){
/*         header('location: /'); */
        Session::destroy();
        echo "<meta http-equiv='refresh' content='0'>";
        exit;
    }
};