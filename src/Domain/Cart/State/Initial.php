<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/05/17
 * Time: 23:17
 */

namespace Peistur\LogisticCart\Cart\State;

class Initial extends AbstractCartState
{
    public function located()
    {
        return new Located();
    }
}