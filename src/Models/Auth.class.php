<?php
class Auth {
    //signup the user
    public static function signup($firstname, $secondname, $username, $email, $password, $cPassword){
        $_exist = new User($username);

        if($_exist) {
            throw new Exception("User already registered account.");
        }
    
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
    //he can login using username and email.
    public static function login($user, $password) {

    }
    //check verification. 
    public static function isVerfied($identifier) {
        $sql = '';


        $stmt = $db->prepare();
        $user = $stmt->execute([]);

        if(!$user) {
            throw new Exception('User not found');
        }

        if($user['is_verified'] !== 1) {
            throw new Exception('User is not verified their account');
        }

        return $user['is_verified'];
    }
}