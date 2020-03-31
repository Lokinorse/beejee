<?php 
require_once 'database.php';

class Model 
{

    function __construct ()
    {
       $this->db = new Database(); 
    }

    function xhrPost()
    {
        $task =  $_POST['task'];
        $task = htmlspecialchars($task, ENT_QUOTES, 'UTF-8');

        $name = $_POST['name'];
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

        $email = $_POST['email'];
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $statuss = $_POST['statuss'];

        $sth = $this->db->prepare('INSERT INTO tasks (task, name, email) VALUE (:task, :name, :email)');
        $sth->execute([':task' => $task,
                       ':name' => $name,
                       ':email'=>$email,
                      ]);

    }


    public function numberOfPages(){
        global $number_of_pages;
        $number_of_tasks = $this->db->prepare('SELECT * FROM TASKS');
        $number_of_tasks->execute();
        $number_of_tasks = $number_of_tasks->fetchAll();
        $number_of_pages = ceil(count($number_of_tasks)/3);
    }

    public function xhrGetTasks($offset, $sort)
    {
        $this->numberOfPages();
        global $number_of_pages;
        $curPage = $offset-1;
        $pag_limit = 3;
        --$offset;
        $offset = $offset*3;
        Session::set('sort', $sort);
        $sort = $_SESSION['sort'];

        switch ($sort) {
            case 'name_plus':
                $sth = $this->db->prepare('SELECT * FROM tasks 
                                           ORDER BY name DESC
                                           LIMIT :offset, :pag_limit');

                break;
            case 'name_minus':
                $sth = $this->db->prepare('SELECT * FROM tasks 
                                           ORDER BY name ASC
                                           LIMIT :offset, :pag_limit');
                break;
                case 'mail_plus':
                    $sth = $this->db->prepare('SELECT * FROM tasks 
                                               ORDER BY email DESC
                                               LIMIT :offset, :pag_limit');
                break;
                case 'mail_minus':
                    $sth = $this->db->prepare('SELECT * FROM tasks 
                                               ORDER BY email ASC
                                               LIMIT :offset, :pag_limit');
                break;
                case 'status_off':
                    $sth = $this->db->prepare('SELECT * FROM tasks 
                                               ORDER BY status ASC
                                               LIMIT :offset, :pag_limit');
                break;
                case 'status_on':
                    $sth = $this->db->prepare('SELECT * FROM tasks 
                                               ORDER BY status DESC
                                               LIMIT :offset, :pag_limit');
                break;
            default:
                $sth = $this->db->prepare('SELECT * FROM tasks LIMIT :offset, :pag_limit');

        } 
        $sth->bindParam(":pag_limit", $pag_limit, PDO::PARAM_INT);
        $sth->bindParam(":offset", $offset, PDO::PARAM_INT);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $data = $sth->fetchAll();
        array_push($data, $number_of_pages);
        array_push($data, $curPage);
        echo json_encode($data);

    }

    function xhrDeleteTasks()
    {
        $post_id = key( $_POST );
        $sth = $this->db->prepare('DELETE FROM tasks WHERE id=:post_id');
        $sth->execute([':post_id' => $post_id]);
        echo "<meta http-equiv='refresh' content='0'>";

    }

    function UpdateStatus()
    {
        $update_id = key( $_POST );
        $sth = $this->db->prepare('UPDATE tasks SET STATUS = 1 WHERE id =:update_id');
        $sth->execute([':update_id' => $update_id]);
        echo "<meta http-equiv='refresh' content='0'>";

    }

    function EditTask()
    {
        

    }

}