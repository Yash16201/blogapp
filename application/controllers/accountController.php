<?php

class accountController extends framework{
    public function index(){
        $this->view("signup");
    }
    public function signin(){
        $this->view("login");
    }
    public function login(){
        $userModel = $this->model('userModel');
        $userData = [
            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'emailErr' => '',
            'passwordErr' => ''
        ];
        if(empty($userData['email'])){
            $userData['emailErr'] = 'This field is required';
        }
        if(empty($userData['password'])){
            $userData['passwordErr'] = 'This field is required';
        }
        if(empty($userData['emailErr']) && empty($userData['passwordErr'])){
            $result = $userModel->userLogin($userData['email'],$userData['password']);
            if($result['status'] === 'emailnotfound'){
                $userData['emailErr'] = 'Email is incorrect';
                $this->view("login",$userData);
            }elseif($result['status'] === 'passwordnotmatched'){
                $userData['passwordErr'] = 'Password is incorrect';
                $this->view("login",$userData);
            }elseif($result['status'] === 'ok') {
                $this->setSession("userId",$result['data']);
                header("location: http://localhost/blogapp/blog/");
            }
        }else{
            $this->view("login",$userData);
        }
    }
    public function signUp(){
        $userModel = $this->model('userModel');
        $userData = [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'gender' => $this->input('gender'),
            'contact' => $this->input('contact'),
            'password' => $this->input('password'),
            'nameErr' => '',
            'emailErr' => '',
            'genderErr' => '',
            'contactErr' => '',
            'passwordErr' => ''
        ];
        if(empty($userData['name'])){
            $userData['nameErr'] = 'This field is required';
        }
        if(empty($userData['email'])){
            $userData['emailErr'] = 'This field is required';
        }else{
            if(!$userModel->checkemail($userData['email'])){
                $userData['emailErr'] = 'This email is already been used';
            }
        }
        if(empty($userData['gender'])){
            $userData['genderErr'] = 'This field is required';
        }
        if(empty($userData['contact'])){
            $userData['contactErr'] = 'This field is required';
        }
        if(empty($userData['password'])){
            $userData['passwordErr'] = 'This field is required';
        }
        if(empty($userData['nameErr']) && empty($userData['emailErr']) && empty($userData['gnederErr']) && empty($userData['contactErr']) && empty($userData['passwordErr'])){
            $pass = password_hash($userData['password'], PASSWORD_DEFAULT);
            $inpdata = [$userData['name'],$userData['email'],$userData['gender'],$userData['contact'],$pass];
            if($userModel->usersignup($inpdata)){
                $this->setFlash("accountcreated","Account created successfully");   
                header("location: http://localhost/blogapp/accountController/signin");
            }else{
                echo "Error";
            }
        }else{
            $this->view("signup",$userData);
        }
    }  
}

?>