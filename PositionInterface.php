<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Cart;

/**
 * Interface PositionInterface
 */
interface PositionInterface
{
    /**
     * Return total price: product.price * quantity.
     *
     * @return float
     */
    public function getPrice(): float;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface;

    /**
     * @return string
     */
    public function generateUniqueId(): string;

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity);
}