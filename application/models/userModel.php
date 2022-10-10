<?php

class userModel extends database{
    public function usersignup($data){
        if($this->Query("INSERT INTO user(user_name, user_email, user_gender, user_contact, password) VALUES (?,?,?,?,?)", $data)){
            return true;
        }else{
            return false;
        }
    }

    public function userLogin($email,$pass){
        if($this->Query("SELECT * FROM user WHERE user_email=?",[$email])){
            if($this->rowCount() > 0){
                $row =  $this->fetch();
                $dbPassword = $row->password;
                $id= $row->user_id;
                if(password_verify($pass , $dbPassword)){
                    return ['status' => 'ok', 'data' => $id];
                }else{
                    return ['status' => 'passwordnotmatched'];
                }
            }else{
                return ['status' => 'emailnotfound'];
            }
        }
    }

    public function checkemail($email){
        if($this->Query("SELECT * FROM user WHERE user_email=?", [$email])){
            if($this->rowCount() > 0){
                return false;
            }else{
                return true;
            }
        }
    }
}

?>