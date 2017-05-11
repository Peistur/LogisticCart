<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 11/05/17
 * Time: 23:51
 */

namespace Peistur\LogisticCart\Cart\State;

class Located extends AbstractCartState
{
    public function scheduled()
    {
        return new Scheduled();
    }
}