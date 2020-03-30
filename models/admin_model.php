<?php
require_once './core/model.php';
require_once './core/view.php';
class Admin_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->view=new View();
    }
    public function login()
    {

        $sth =  $this->db->prepare("SELECT name FROM users WHERE login = :login 
                AND password = MD5(:password)");
        $sth->execute(array(
            ':login' => $_POST['login'],
            ':password' => $_POST['password']
        ));
        $data = $sth->fetchAll ();
        if ($sth->rowCount()>0){

            Session::init();
            Session::set('admin_logged', true);
            header('location: ../admin_logged');
        } else {
            header('location: ../incorrect_credentials');
        }
        
    }
} 