<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/05/17
 * Time: 23:02
 */

namespace Peistur\LogisticCart\Cart;

use Peistur\LogisticCart\Cart\State\Initial;
use Rhumsaa\Uuid\Uuid;

final class Cart
{
    private $id;
    private $cartLines;
    private $linesAmount;
    private $shippingAmount;
    private $state;
    private $owner;
    private $location;
    private $deliveryShift;

    public static function anonymous($id)
    {
        return new self($id);
    }

    public static function owned($id, $owner)
    {
        $cart = new self($id);
        $cart->ownedBy($owner);
        return $cart;
    }

    public function __construct($id)
    {
        $this->id = $id;
        $this->state = new Initial();
        $this->cartLines = [];
    }

    public function add(Item $item, int $quantity = 1)
    {
        $itemCartLine = array_filter($this->cartLines, function ($cartLine) use ($item) {
            if ($cartLine->item() === $item) {
                return true;
            }
            return false;
        });

        if (count($itemCartLine) === 1) {
            (reset($itemCartLine))->add($item, $quantity);
        }

        if (empty($itemCartLine)) {
            $itemCartLine[] = new CartLine(Uuid::uuid4(), $item, $quantity);
        }

        // TODO: Add new Event
    }

    public function ownedBy($owner)
    {
        $this->owner = $owner;

        // TODO: Add new Event
    }

    public function place($location)
    {
        $this->location = $location;
        $this->state = $this->state->located();

        // TODO: Add new Event
    }

    public function schedule($shift)
    {
        $this->deliveryShift = $shift;
        $this->state = $this->state->scheduled();

        // TODO: Add new Event
    }

    public function unschedule()
    {
        $this->state = $this->state->unscheduled();

        // TODO: Add new Event
    }

    public function ordered()
    {
        $this->state = $this->state->ordered();

        // TODO: Add new Event
    }
}