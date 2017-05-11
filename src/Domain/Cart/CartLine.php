<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/05/17
 * Time: 0:14
 */

namespace Peistur\LogisticCart\Cart;

use Rhumsaa\Uuid\Uuid;
use SebastianBergmann\Money\Money;

class CartLine
{
    private $id;
    private $item;
    private $quantity;

    public function __construct(Uuid $id, Item $item, int $quantity)
    {
        $this->id = $id;
        $this->add($item, $quantity);
    }

    public function add(Item $item, int $quantity)
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('Quantity in a cartLine must be greater than 0');
        }

        if (!$this->item instanceof Item) {
            $this->item = $item;
        }

        if ($this->item !== $item) {
            throw new InvalidItem(sprintf('Invalid item %s for current CartLine %s',
                $item->name(), $this->id));
        }

        $this->quantity = $this->quantity + $quantity;
    }

    public function subtract(int $quantity = 1)
    {
        if ($quantity > $this->quantity) {
            throw new \InvalidArgumentException('Can\'t remove more quantity than the actual quantity');
        }
        $this->quantity = $this->quantity - $quantity;
    }

    public function isEmpty()
    {
        return $this->quantity === 0;
    }

    public function totalPrice(): Money
    {
        return $this->item->cost()->multiply($this->quantity);
    }

    public function item()
    {
        return $this->item;
    }

    public function quantity()
    {
        return $this->quantity;
    }
}