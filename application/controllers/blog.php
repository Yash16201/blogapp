<?php

class blog extends framework{
    public function index(){
        if($this->getSession('userId')){
            $this->view("bloghome");
        }else{
            header("location: http://localhost/blogapp/accountController/signin");
        }
        
    }
}
?>