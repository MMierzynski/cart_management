<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddTwiceTheSameProductToCartShouldReturnOneCartItem(): void
    {
        $expectedCount = 1;
        $expectedCartItemsInBasket = 2;

        $product = new Product();
        $product
            ->setName("Test Product")
            ->setPrice(10);

        $cart = new Cart();

        for ($i = 0; $i < 2; $i++) {
            $cartItem = new CartItem();
            $cartItem
                ->setProduct($product)
                ->setAmount(1);

            $cart->addItem($cartItem);
        }

        $this->assertCount($expectedCount, $cart->getItems());
        $this->assertSame($expectedCartItemsInBasket, $cart->getItems()->get(0)->getAmount());
    }
}
