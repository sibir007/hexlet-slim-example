<?php

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/Generator.php'; 
use App\Generator;


$companies = \App\Generator::generate(100);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($configuration);

// BEGIN (write your solution here)
$app->get('/companies/{id}', function ($request, $response, array $args) use ($companies){
    $id = $args['id'];
    $company = collect($companies)->firstWhere('id', $id);
    $jsonCompany = json_encode($company);
    return $response->write($jsonCompany);

});
$app->run();
// END

