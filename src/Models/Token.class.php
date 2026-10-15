<?php

class Token {
    public static function create($uid = null) {
        //error_log('Token::create() called: ' . $uid);
        //error_log("Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'unknown'));


        $db = Database::connect();
        $expires = gmdate('Y-m-d H:i:s', time() + 900);
        // echo $expires;
        //raw token for send to client
        $token = bin2hex(random_bytes(32));
        // echo $rawToken;
        $tokenHASH = hash('sha256', $token);
        // echo $tokenHASH;
        $sql = "INSERT INTO `access_tokens` (`user_id`, `token_hash`, `expires_at`) VALUES (:uid, :token_hash, :expires);";
        // Test::_this($sql);
        $stmt = $db->prepare($sql);
        // Test::_this($stmt);
        $stmt->execute([
            ':uid' => $uid,
            ':token_hash' => $tokenHASH,
            ':expires' => $expires
        ]);
        return $token;
    }

    public static function findValid($token_hash) {
        $db = Database::connect();

        $sql = 'SELECT user_id FROM access_tokens
             WHERE token_hash = ?
             AND expires_at > UTC_TIMESTAMP()';

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':token_hash' => $token_hash
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function revoke($uid = null)  {
        $db = Database::connect();

        $sql = "DELETE FROM `access_tokens` WHERE ((`user_id` = :uid));";
        // Test::_this($sql);
        $stmt = $db->prepare($sql);
        // Test::_this($stmt);z
        $stmt->execute([
            ':uid' => $uid,
        ]);
        return 1;
    }
}

