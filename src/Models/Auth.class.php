<?php
class Auth {

    public static function signup($firstname, $secondname, $username, $email, $password, $cPassword){
        $data = json_encode([
            'firstname' => $firstname,
            'secondname' => $secondname,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            //'c_password' => $cPassword
        ]);
        
        $id = User::create($data);
        return $id;
    }
}