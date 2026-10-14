<?php
require_once 'api.php';
require_once 'src/Core/Database.php';


$db = Database::connect();

if($db) {
    http_response_code(200);
    echo json_encode([
        'success' => "Database connected successfully."
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'error' => "Database connection is failed."
    ]);
}
// $user = new User();
// $user->inserToken();