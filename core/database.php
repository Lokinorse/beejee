<?php
require 'config.php';
class Database extends PDO
{
    public function __construct()
    {
/*         parent::__construct('mysql:host=localhost; dbname=beejee', 'root', ''); */
        parent::__construct(DB_TYPE .':host=' . HOST. '; dbname='. DBNAME, USER, PASS);
    }
}