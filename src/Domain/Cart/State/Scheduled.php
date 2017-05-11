<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/05/17
 * Time: 23:51
 */

namespace Peistur\LogisticCart\Cart\State;

class Scheduled extends AbstractCartState
{
    public function ordered()
    {
        return new Ordered();
    }

    public function unscheduled()
    {
        return new Located();
    }
}