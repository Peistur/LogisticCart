<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/05/17
 * Time: 23:18
 */

namespace Peistur\LogisticCart\Cart\State;

use Peistur\LogisticCart\InvalidStateTransitionException;

abstract class AbstractCartState
{
    public function located()
    {
        throw new InvalidStateTransitionException();
    }

    public function scheduled()
    {
        throw new InvalidStateTransitionException();
    }

    public function unscheduled()
    {
        throw new InvalidStateTransitionException();
    }

    public function ordered()
    {
        throw new InvalidStateTransitionException();
    }
}