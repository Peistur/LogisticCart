<?php

use Peistur\LogisticCart\Cart\Item;
use PHPUnit\Framework\TestCase;
use Tests\Utils\ItemUtils;

/**
 * @covers Item
 */
final class ItemTest extends TestCase
{
    use ItemUtils;

    public function testCanBeCreated()
    {
        $item = self::defaultItem('100');

        $this->assertInstanceOf(
            Item::class,
            $item
        );
    }
}