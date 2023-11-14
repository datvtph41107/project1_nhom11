<?php
namespace app\core;

class Session 
{
    public function __construct()
    {
        session_start();    
    }
    
    public function set($key, $value) 
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}