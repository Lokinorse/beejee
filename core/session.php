<?php 

class Session 
{
    public static function init()
    {
        if(!isset($_SESSION)){
        session_start();
        }
    }

    public static function set($key, $value)
    {
        session_start();
        $_SESSION[$key] = $value;
    }
    public static function get ($key)
    {
        if(isset($_SESSION)){    
            return $_SESSION[$key];
        }
    }
    public static function destroy()
    {
        if(isset($_SESSION)){
/*             unset($_SESSION); */
            session_destroy();

        }
    }

}