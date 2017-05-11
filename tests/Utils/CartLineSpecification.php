<?php

namespace Tests\Utils;

use Peistur\LogisticCart\Cart\Item;

final class CartLineSpecification
{
    private $item;
    private $quantity;

    public static function create(Item $item, int $quantity)
    {
        return new self($item, $quantity);
    }

    private function __construct(Item $item, int $quantity)
    {
        $this->item = $item;
        $this->quantity = $quantity;
    }

    public function item(): Item
    {
        return $this->item;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}