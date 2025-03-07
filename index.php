<?php

// Este archivo es para atender solicitudes HTTP usando nginx, pero decidí no continuarlo
// debido a que no estaba descrito en la prueba técnica.

// Sin embargo, funciona y para activarlo hace falta descomentar el servicio nginx en el docker-composer.yml
// y realizar una solicitud POST a localhost/users pasando los datos.

// En el archivo en scripts/POST_test.sh contiene un ejemplo de solicitud POST hecha con cURL

use App\Controllers\RegisterUserController;

require_once __DIR__ . '/bootstrap.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


// router básico
switch ($method) {
    case 'GET':
        switch ($request) {
            case '/users':
                http_response_code(200);
                echo '<h1>Hola mundo</h1>';
                exit;
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
    default:
        http_response_code(405);
        break;
}
