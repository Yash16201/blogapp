<?php

class userModel extends database{
    public function usersignup($data){
        if($this->Query("INSERT INTO user(user_name, user_email, user_gender, user_contact, password) VALUES (?,?,?,?,?)", $data)){
            return true;
        }else{
            return false;
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