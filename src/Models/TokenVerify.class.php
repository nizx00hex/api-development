<?php
class HashVerify {

    // public function __construct() {
        
    // }
    /**
     * This TOKEN will saving in database, 
     * one time use the token, if user close the browser this token will expired,
     * then generate new token he again visit the browser
     * 
     * when expired. if someone steal that used token and use that token at the same time that token expired,
     * he can't inside dashboard
     */
    public static function tokenGenerator($username){//$id, $username, $length = 16
        /**
         * id
         * user_id
         * key
         * token
         * created_at
         * updated_at
         */
        // $key = bin2hex(random_bytes(8));
        $key = bin2hex(random_bytes(32));
        
        
        $userHash = $username.$key;

        $token = password_hash($userHash ,PASSWORD_DEFAULT);

        //first this token 2 parts is the key.
        return [
            'key' => $key,
            'token' => $token
        ];
        //{8190f4b832a181347c022ab2469a5663}.{c4ca4238a0b923820dcc509a6f75849b}.{d1f3da6f590819cdedf98e9a8ea38313}
            // username                               //id                                //secret_token
    }

    public static function insertToken($username){
        $db = Database::connect();
        $user = self::tokenGenerator($username);
        $uid = new User($username);
        $uid = $uid->getId();
        $sql = "INSERT INTO `hash_verify` (`uid`, `key`, `token`, `created_at`) VALUES (:id, :key, :token, now());";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $uid,
            ':key' => (string)$user['key'],
            ':token' => (string)$user['token']
        ]);

        return $db->lastInsertId();
    }

    public static function verifyTheHash($username, $key) {
        /**
         * fecth from database.
         */

        $token = self::_isTokenExist($username);
        // echo $token;
        $storedHash = $token; 

        $userHash = $username.$key;

        if(password_verify($userHash, $storedHash)) {
            return 'verification success';
        }

        return 'verification failed';
    }


    public static function _isTokenExist($username) {
        //this method is just hardcodded.
        $db = Database::connect();

        $sql = 'SELECT id FROM `users` WHERE username = :username LIMIT 1';

        $stmt = $db->prepare($sql);
        
        $stmt->execute([
            ':username' => $username
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        
        if(!$user) {
            throw new Exception("User doesn't exists");
        }
        $uid = $user['id'];

        $sql = 'SELECT `token`, `key` FROM `hash_verify` WHERE uid = :uid LIMIT 1';
        // $sql = 'SELECT `token` FROM `hash_verify` WHERE `uid` = :uid LIMIT 1';
        
        $stmt = $db->prepare($sql);

        $stmt->execute([
            ':uid' => $uid
        ]);

        $token = $stmt->fetch(PDO::FETCH_ASSOC);
        // Test::_this($token);
        if(!$token || empty($token['token'])) {
            throw new Exception('Token is not available');
        }

        $storeToken = $token['token'];

        return $storeToken;
    }

    public function revoke() {
        try {
            $sql = '';
            
            $stmt = $db->prepare();
            $stmt->execute([
                
            ]);


        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
