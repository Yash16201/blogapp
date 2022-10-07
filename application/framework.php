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
}

?>