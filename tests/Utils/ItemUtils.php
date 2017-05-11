<?php

namespace Tests\Utils;

use Peistur\LogisticCart\Cart\Item;
use Rhumsaa\Uuid\Uuid;

trait ItemUtils
{
    use MoneyUtils;

    protected static function defaultItem(string $amount): Item
    {
        return new Item(
            Uuid::uuid4(),
            'Test Item',
            self::moneyFromDefaultCurrency($amount)
        );
    }
}