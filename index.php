<?php
require_once 'src/__init__.php';

$db = Database::connect();
//id	firstname	secondname	username	emai
// $data = [
//     'name'=>'nisath',
//     'firstname' => 'Muhammed',
//     'secondname' => 'Nisath',
//     'email' => 'nisathnisath606@gmail.com'
// ];
// $data = json_encode([
//     'firstname' => 'Nisath',
//     'secondname' => 'Muhammed',
//     'username'=>'muhammed',
//     'email' => 'muhammed@gmail.com',
// ]);

// Auth::register($data);


// if($db) {
//     http_response_code(200);
//     echo json_encode([
//         'success' => "Database connected successfully."
//     ]);
// } else {
//     http_response_code(500);
//     echo json_encode([
//         'error' => "Database connection is failed."
//     ]);
// }
// $user = new User();
// $user->inserToken();



// preg_match('/(foo)(bar)(baz)/', 'foobarbaz', $matches, PREG_OFFSET_CAPTURE);
// echo "<pre>";
// print_r($matches[1]);
// echo "</pre>";
Token::create(8);
?>