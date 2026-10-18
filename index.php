<?php

require_once 'src/__init__.php';

// header('Content-Type: application/json');

// // 1. Read Authorization header
// $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

// // 2. Extract Bearer token
// if (!preg_match('/^Bearer\s+(\S+)$/i', $authHeader, $matches)) {
//     http_response_code(401);
//     echo json_encode(['error' => 'Bearer token required']);
//     exit;
// }

// $token = $matches[1];

// // 3. Hash the token
// $tokenHash = hash('sha256', $token);

// // 4. Validate token against database
// $tokenData = Token::findValid($tokenHash);

// if (!$tokenData) {
//     http_response_code(401);
//     echo json_encode(['error' => 'Invalid or expired token']);
//     exit;
// }

// // 5. Token is valid
// echo json_encode([
//     'success' => true,
//     'message' => 'Authentication successful',
//     'user_id' => $tokenData['user_id']
// ]);

// $id = Auth::signup('Muhammed', 'Nisath', 'nisath', 'nisathnisath@gmail.com', 'password', 'password');
// echo $id;

$verfication = HashVerify::verifyTheHash('nisath', '84f2b448ea570b0cf954e2ac614d54335242a3e27f3b6184d2f228978805b2fb');
echo $verfication;
// // Test::_test();

// echo HashVerify::verifyTheHash('8190f4b832a181347c022ab2469a5663', 'c4ca4238a0b923820dcc509a6f75849b', 12345678);


//output: c0133544d9bfdc304c0ad262697e7fc8.username+id



