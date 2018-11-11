<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/Generator.php';
use App\Generator;
use Slim\Views\PhpRenderer;
require __DIR__ . "/../vendor/PHP-View/src/PhpRenderer.php";

$users = \App\Generator::generate(100);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ]
];
$app = new \Slim\App($configuration);
$container = $app->getContainer();

$container['renderer'] =  new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');

$app->get('/', function ($request, $response) {
    return $this->renderer->render($response, 'a1.ph'); 
});
$app->get('/users', function ($request, $response) use ($users) {
    $page = $request->getQueryParam('page', 1);
    $per = $request->getQueryParam('per', 5);
    $resUsersArr = 
    [
        'users' => array_slice($users, ($page-1) * $per, $per),
        'param' => [$page, $per]
    ];
    return $this->renderer->render($response, '/users/index.phtml', $resUsersArr);
});
$app->get('/users/{id}', function ($request, $response, $args) use ($users) {
    $id= $args['id'];
    $user = collect($users)->firstWhere('id', $id);
    return $this->renderer->render($response, 'users/show.phtml', $user);
});
$app->run();
// END

