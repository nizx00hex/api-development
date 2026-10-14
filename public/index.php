<?php
require_once __DIR__ . '/../src/Core/Response.php';
require_once __DIR__ . '/../src/Core/Request.php';
require_once __DIR__ . '/../src/Core/Router.php';
//done
Router::get('/ping', function() {
    Response::json([
        'message' => 'pong'
    ]);
});

//done
Router::get('/users', function() {
    Response::json([
        'users' => [
            [
                'id' => 1,
                'name' => 'nisath',
            ],
            [
                'id' => 2,
                'name' => 'teora'
            ]
        ]
    ]);
});

//done
Router::post('/users', function() {
    $body = Request::body();

    if(empty($body['name'])) {
        Response::json([
            'error' => 'name is required'
        ], 422);
    }
    Response::json([
        'message' => 'User created',
        'name' => $body['name']
    ], 201);
});
//done
Router::put('/users', function() {
    Response::json([
        'message' => 'User updated'
    ]);
});


Router::delete('/users', function() {
    $id = $_GET['id'] ?? '';

    if(!ctype_digit($id)) {
        Response::json([
            'error' => 'valid numeric id is required'
        ], 422);
    }

    Response::json([
        'success' => "User $id is deleted successfully"
    ]);
    
});

Router::get('/about', function() {
    Response::json([
        'status' => 'success',
        'name'  => 'API Core',
        'version' => '1.1.0 v'

    ]);
});

Router::dispatch();