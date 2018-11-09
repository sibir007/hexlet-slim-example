<?php

require __DIR__ . '/../vendor/autoload.php';


$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
	],
];

$app = new \Slim\App($configuration);

$app->get('/', function ($request, $response) {
	return $response->write('Welome to Slim!');
});
$app->run();
