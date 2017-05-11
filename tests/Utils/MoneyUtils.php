<?php

namespace Tests\Utils;

use SebastianBergmann\Money\Money;

trait MoneyUtils
{
    public static function moneyFromDefaultCurrency(string $amount): Money
    {
        return Money::fromString($amount, 'EUR');
    }

    public static function moneyFromNotDefaultCurrency(string $amount): Money
    {
        return Money::fromString($amount, 'USD');
    }
}