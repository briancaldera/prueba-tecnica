<?php

use App\Controllers\RegisterUserController;

require_once __DIR__ . '/bootstrap.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        switch ($request) {
            case '/users':
                http_response_code(200);
                echo '<h1>Hello World</h1>';
                return json_encode(['data' => 'OK']);
                break;

            default:
                http_response_code(404);
                break;
        }

        break;
    case 'POST':
        switch ($request) {
            case '/users':
                $requestBody = file_get_contents('php://input');
                $data = json_decode($requestBody, true);

                if ($data === null) {
                    // JSON decoding failed
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Invalid JSON']);
                    exit;
                }

                if ($data === null) {
                    // JSON decoding failed
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Invalid JSON']);
                    exit;
                }

                if ($data) {

                    $controller = new RegisterUserController();
                    $req = [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password'=> $data['password'],
                    ];

                    $res = $controller->RegisterUser($req);

                    echo $res;
                    exit;
                }
                break;

            default:
                http_response_code(404);
                break;
        }
        break;
    case 'DELETE':
        switch ($request) {
            case 'value':

                break;

            default:
                http_response_code(404);
                break;
        }
        break;
    default:
        http_response_code(405);
        break;
}
