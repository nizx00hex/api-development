<?php
require_once 'Database.class.php';
require_once 'Test.class.php';
class Token {
    public static function create($id = null) {
        $db = Database::connect();
        $expires = gmdate('Y-m-d H:i:s', time() + 900);
        echo $expires;
        //raw token for send to client
        $token = bin2hex(random_bytes(32));
        // echo $rawToken;
        $tokenHASH = hash('sha256', $token);
        echo $tokenHASH;

        $sql = "INSERT INTO `access_tokens` (`user_id`, `token_hash`, `expires_at`) VALUES (:uid, :token_hash, :expires);";

        
        Test::_this($sql);
        

        $stmt = $db->prepare($sql);
        Test::_this($stmt);

        $stmt->execute([
            ':uid' => $id,
            ':token_hash' => $tokenHASH,
            ':expires' => $expires
        ]);
        return $token;
    }
}

