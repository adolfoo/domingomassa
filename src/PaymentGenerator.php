<?php
declare(strict_types=1);

namespace Adolfoo\DomingoMassa;

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\CheckoutService;

final class PaymentGenerator
{
    /**
     * @var CheckoutService
     */
    private $checkoutService;

    /**
     * @var ProductList
     */
    private $products;

    public function __construct(
        CheckoutService $checkoutService,
        ProductList $products
    ) {
        $this->products        = $products;
        $this->checkoutService = $checkoutService;
    }

    public function generate(array $request): array
    {
        $builder    = $this->checkoutService->createCheckoutBuilder();
        $extraAmount = 0;

        foreach ($request as $item) {
            $product    = $this->products->get((int) $item['name']);
            $price      = $product['price'];
            $quantity   = (int) $item['value'];

            if ($price <= 0) {
                $price = 1;
                $extraAmount -= $price * $quantity;
            }

            $builder->addItem(new Item($product['id'], $product['label'], $price, $quantity));
        }

        $builder->setExtraAmount($extraAmount);

        $redirect = $this->checkoutService->checkout($builder->getCheckout());

        return ['code' =>  $redirect->getCode()];
    }
}
