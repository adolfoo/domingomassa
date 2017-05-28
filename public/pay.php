<?php
declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

use Adolfoo\DomingoMassa\PaymentGenerator;
use Adolfoo\DomingoMassa\ProductList;
use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

header('Content-Type: application/json');

$credentials = new Credentials(
    getenv('PAGSEGURO_EMAIL'),
    getenv('PAGSEGURO_PASS'),
    getenv('PAGSEGURO_ENV') === 'test' ? new Sandbox() : null
);

$generator = new PaymentGenerator(
    new CheckoutService($credentials),
    new ProductList()
);

echo json_encode(
    $generator->generate(
        json_decode(
            file_get_contents('php://input'),
            true
        )
    )
);
