<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/05/17
 * Time: 0:27
 */

namespace Peistur\LogisticCart\Cart;

use Rhumsaa\Uuid\Uuid;
use SebastianBergmann\Money\Money;

class Item
{
    private $id;
    private $name;
    private $price;

    public function __construct(Uuid $id, string $name, Money $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cost(): Money
    {
        return $this->price;
    }
}