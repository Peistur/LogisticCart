<?php

namespace Tests\Utils;

use Peistur\LogisticCart\Cart\CartLine;
use Peistur\LogisticCart\Cart\Item;
use Rhumsaa\Uuid\Uuid;

trait CartLineUtils
{
    use ItemUtils;

    protected static function defaultCartLine(int $quantity): CartLine
    {
        $item = self::defaultItem('100');

        return new CartLine(Uuid::uuid4(), $item, $quantity);
    }

    protected static function defaultCartLineFromPrice(int $quantity, string $priceAmount): CartLine
    {
        $item = self::defaultItem($priceAmount);

        return new CartLine(Uuid::uuid4(), $item, $quantity);
    }

    protected static function createCartLine(Item $item, int $quantity): CartLine
    {
        return new CartLine(Uuid::uuid4(), $item, $quantity);
    }
}