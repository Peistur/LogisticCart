<?php

use Peistur\LogisticCart\Cart\CartLine;
use Peistur\LogisticCart\Cart\InvalidItem;
use PHPUnit\Framework\TestCase;
use Tests\Utils\CartLineUtils;
use Tests\Utils\CartLineSpecification;

/**
 * @covers CartLine
 */
final class CartLineTest extends TestCase
{
    use CartLineUtils;

    public function testCanBeCreated()
    {
        $cartLine = self::defaultCartLine(1);

        $this->assertInstanceOf(
            CartLine::class,
            $cartLine
        );
    }

    public function assertPriceAndQuantity($totalAmount, $totalQuantity, CartLine $cartLine)
    {
        $this->assertEquals($cartLine->totalPrice()->getAmount(), self::moneyFromDefaultCurrency($totalAmount)->getAmount());
        $this->assertEquals($cartLine->totalPrice()->getCurrency(), self::moneyFromDefaultCurrency($totalAmount)->getCurrency());
        $this->assertEquals($cartLine->quantity(), $totalQuantity);
    }

    /**
     * @dataProvider provider_valid_addition_data
     */
    public function testAddExistingItem($totalAmount, $totalQuantity, CartLineSpecification ...$cartLineAddSpecifications)
    {
        $cartLine = null;

        foreach ($cartLineAddSpecifications as $cartLineAddSpecification) {
            if (!$cartLine instanceof CartLine) {
                $cartLine = self::createCartLine($cartLineAddSpecification->item(), $cartLineAddSpecification->quantity());
                continue;
            }

            $cartLine->add($cartLineAddSpecification->item(), $cartLineAddSpecification->quantity());
        }

        $this->assertPriceAndQuantity($totalAmount, $totalQuantity, $cartLine);
    }

    public function testAddInvalidQuantity()
    {
        $item = self::defaultItem('100');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Quantity in a cartLine must be greater than 0');

        self::createCartLine($item, 0);
    }

    public function testAddInvalidItem()
    {
        $item = self::defaultItem('100');
        $otherItem = self::defaultItem('200');

        $this->expectException(InvalidItem::class);

        $cartLine = self::createCartLine($item, 1);
        $cartLine->add($otherItem, 2);
    }

    /**
     * @dataProvider provider_valid_subtract_data
     */
    public function testSubtract(
        $totalAmount,
        $totalQuantity,
        CartLineSpecification $cartLineAddSpecification,
        int ...$subtractQuantities
    )
    {
        $cartLine = self::createCartLine($cartLineAddSpecification->item(), $cartLineAddSpecification->quantity());
        
        foreach ($subtractQuantities as $subtractQuantity) {
            $cartLine->subtract($subtractQuantity);
        }

        $this->assertPriceAndQuantity($totalAmount, $totalQuantity, $cartLine);
    }

    /**
     * @dataProvider provider_invalid_subtract_data
     */
    public function testSubtractInvalidQuantity(
        CartLineSpecification $cartLineAddSpecification,
        int ...$subtractQuantities
    )
    {
        $cartLine = self::createCartLine($cartLineAddSpecification->item(), $cartLineAddSpecification->quantity());

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Can\'t remove more quantity than the actual quantity');

        foreach ($subtractQuantities as $subtractQuantity) {
            $cartLine->subtract($subtractQuantity);
        }
    }

    public function provider_valid_addition_data(): array
    {
        $item = self::defaultItem('100');

        return [
            [
                100,
                1,
                CartLineSpecification::create($item, 1)
            ],
            [
                800,
                8,
                CartLineSpecification::create($item, 4),
                CartLineSpecification::create($item, 4)
            ],
            [
                1000,
                10,
                CartLineSpecification::create($item, 5),
                CartLineSpecification::create($item, 2),
                CartLineSpecification::create($item, 3)
            ]
        ];
    }

    public function provider_valid_subtract_data(): array
    {
        $item = self::defaultItem('100');

        return [
            [
                0,
                0,
                CartLineSpecification::create($item, 1),
                1
            ],
            [
                700,
                7,
                CartLineSpecification::create($item, 10),
                1,
                2
            ],
            [
                900,
                9,
                CartLineSpecification::create($item, 15),
                1,
                2,
                3
            ]
        ];
    }

    public function provider_invalid_subtract_data(): array
    {
        $item = self::defaultItem('100');

        return [
            [
                CartLineSpecification::create($item, 5),
                6
            ],
            [
                CartLineSpecification::create($item, 10),
                8,
                5
            ],
            [
                CartLineSpecification::create($item, 10),
                2,
                2,
                7
            ]
        ];
    }
}