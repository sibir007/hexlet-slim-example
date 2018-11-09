<?php

require __DIR__ . '/../vendor/autoload.php';



class Generator1
{
    public static function generate($count)
    {
        $numbers = range(1, 100);
        shuffle($numbers);

        $faker = \Faker\Factory::create();
        $faker->seed(1);
        $companies = [];
        for ($i = 0; $i < $count; $i++) {
            $companies[] = [
                'id' => $numbers[$i],
                'name' => $faker->company,
                'phone' => $faker->phoneNumber
            ];
        }

        return $companies;
    }
}

$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
	],
];

$app = new \Slim\App($configuration);


$companies = Generator1::generate(100);
//print_r($companies[1]);
// BEGIN (write your solution here)
$app->get('/companies', function ($request, $response) use ($companies) {
	echo "in get";
    $page = $request->getQueryParam('page', 1);
    $per = $request->getQueryParam('per', 1);
    $rezCompanyTab = array_slice($companies, ($page-1) * $per, $per);
    echo "print rezCompanyTab";
    print_r($rezCompanyTab);
    $jsonRezCompanyTab = json_encode($rezCompanyTab);
    return $response->write($jsonRezCompanyTab);
});
$app->run();
// END

