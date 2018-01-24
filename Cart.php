<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Cart;

use Mindy\Cart\Storage\CartStorageInterface;

class Cart implements CartInterface
{
    /**
     * @var CartStorageInterface
     */
    protected $storage;

    /**
     * Cart constructor.
     *
     * @param CartStorageInterface $storage
     */
    public function __construct(CartStorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->storage->all();
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity(): int
    {
        return array_sum(array_map(function (PositionInterface $position) {
            return $position->getQuantity();
        }, $this->all()));
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return array_sum(array_map(function (PositionInterface $position) {
            return $position->getPrice();
        }, $this->all()));
    }

    /**
     * @param $key
     * @param PositionInterface $position
     */
    public function set(string $key, PositionInterface $position)
    {
        $this->storage->set($key, $position);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(string $key)
    {
        $this->storage->remove($key);
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $key): bool
    {
        return $this->storage->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        return $this->storage->get($key);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->storage->clear();
    }

    /**
     * @param string $key
     * @param int $quantity
     */
    public function setQuantity(string $key, int $quantity)
    {
        $position = $this->get($key);
        $position->setQuantity($quantity);

        $this->storage->set($key, $position);
    }
}
