<?php
require_once 'Test.class.php';

class User {

    private $username = 'nisath';
    private $password = 'password';
    private $token;

    // public function  __construct() {

    //     $user = $_GET['user'];
    //     $pass = $_GET['pass'];

    //     if(!empty($user) and !empty($pass)) {
    //         if($this->username === $user and $this->password === $pass) {
    //             self::Response(
    //                 'success',
    //                 "Welcome back, {$user}.",
    //                 200
    //             );

    //             $this->token = md5('jo');
    //         } else  {
    //             self::Response(
    //                 'error',
    //                 'Please enter correct credentials',
    //                 401
    //             );
    //         }
    //     } else {
    //         self::Response(
    //             'error',
    //             'Please enter your credentials.',
    //             401
    //         );
    //     }
    //     // return $$this->token;
    // }

    public static function create($data = []) {
        try {
            $db = Database::connect();

            $data = json_decode($data, true);
            $sql = "INSERT INTO `users` (`firstname`, `secondname`, `username`, `email`, `password`, `created_at`, `updated_at`, `status`, `is_verified`) VALUES (:firstname, :secondname, :username, :email, :password , NOW(), NULL, 'active', '0');";
            $db->prepare($sql);


            $stmt = $db->prepare($sql);
            Test::_this($stmt);
            $stmt->execute([
                ':firstname' => $data['firstname'],
                ':secondname' => $data['secondname'],
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password' => $data['password']
            ]);

        } catch(PDOException $e) {
            // throw new Exception($e->getMessage());
            echo $e->getMessage();
        }
        return $db->lastInsertId();
    }


    public function insertToken() {
        // echo $this->username;
        // echo $this->token;
        
        /**
         * Insert session
         * id
         * session_token
         * refresh_token
         * created_at
         * update_at
         * //status ENUM('active', 'deactive')
         */

    }

    private static function Response($status, $message, $code) {
        http_response_code($code);
        echo json_encode([
            $status => $message
        ]);
    }
}




