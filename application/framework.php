<?php

class framework{
    public function view($view, $myData = []){
        if(file_exists("../application/views/".$view.".php")){
            require_once "views/$view.php";
        }
        else{
            echo "No such view";
        }
    }

    public function model($model){
        if(file_exists("../application/models/".$model.".php")){
            require_once "models/$model.php";
            return new $model;
        }
        else{
            echo "No such model";
        }
    }

    public function input($inp_name){
        if($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "post"){
            return trim($_POST[$inp_name]);
        }elseif($_SERVER['REQUEST_METHOD'] == "GET" || $_SERVER['REQUEST_METHOD'] == "get"){
            return trim($_GET[$inp_name]);
        }
    }

    public function setSession($sessioname, $sessionvalue){
        if(!empty($sessioname) && !empty($sessionvalue)){
            $_SESSION[$sessioname] = $sessionvalue;
        }
    }

    public function getSession($sessioname){
        if(!empty($sessioname)){
           return $_SESSION[$sessioname];
        }
    }

    public function unsetSession($sessioname){
        if(!empty($sessioname)){
           unset($_SESSION[$sessioname]);
        }
    }

    public function destroy(){
        session_destroy();
    }

    public function setFlash($sessioname, $msg){
        if(!empty($sessioname) && !empty($msg)){
            $_SESSION[$sessioname] = $msg;
        }
    }
    
    public function flash($sessioname, $classname){
        if(!empty($sessioname) && !empty($classname)){
           echo "<div class='".$classname."'>'".$_SESSION[$sessioname]."'</div>";
           unset($_SESSION[$sessioname]);
        }
    }
}

?>

