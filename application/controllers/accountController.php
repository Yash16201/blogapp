<?php

class accountController extends framework{
    public function index(){
        $this->view("signup");
    }
    public function signin(){
        $this->view("login");
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

        // print_r($userData);

        if(empty($userData['nameErr']) && empty($userData['emailErr']) && empty($userData['gnederErr']) && empty($userData['contactErr']) && empty($userData['passwordErr'])){
            $pass = password_hash($userData['password'], PASSWORD_DEFAULT);
            $inpdata = [$userData['name'],$userData['email'],$userData['gender'],$userData['contact'],$pass];
            if($userModel->usersignup($inpdata)){
                $this->view("login");
            }else{
                echo "Error";
            }
        }else{
            $this->view("signup",$userData);
        }
        
        // if($userModel->usersignup($name,$email,$gender,$contact,$password)){
        //     // echo "user submitted";
        //     $this->view("login");
        // }
        
    } 
}

?>