<?php

// //it prevent accidental implicit type conversions.
// declare(strict_types=1);

// //informing the client's network layer that the payload body is JSON encoded in UTF-8
// header("Content-Types: application/json; charset=UTF-8");

// $rm = $_SERVER['REQUEST_METHOD'] ?? 'GET';//Request Method

// if ($rm !== 'GET') {
//     http_response_code(405); //Not Allowed.

//     echo json_encode([
//         'status' => 'error',
//         'message' => "Method {$rm} is not allowed on this endpoint."
//     ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
//     exit;
// }


// $data = [
//     'system' => 'TEORA Core API',
//     'version' => '1.0.0',
//     'status' => 'operational',
//     'server_time' => date('Y-m-d H:i:s')
// ];

// http_response_code(200); //OK

// echo json_encode([
//     'status' => 'success',
//     'data' => $data
// ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

class User {

    private $username = 'nisath';
    private $password = 'password';
    private $token;

    public function  __construct() {

        $user = $_GET['user'];
        $pass = $_GET['pass'];

        if(!empty($user) and !empty($pass)) {
            if($this->username === $user and $this->password === $pass) {
                self::Response(
                    'success',
                    "Welcome back, {$user}.",
                    200
                );

                $this->token = md5('jo');
            } else  {
                self::Response(
                    'error',
                    'Please enter correct credentials',
                    401
                );
            }
        } else {
            self::Response(
                'error',
                'Please enter your credentials.',
                401
            );
        }
        // return $$this->token;
    }


    public function inserToken() {
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




