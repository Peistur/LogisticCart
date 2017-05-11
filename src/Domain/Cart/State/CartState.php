<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 12/05/17
 * Time: 0:05
 */

namespace Peistur\LogisticCart\Cart\State;

interface CartState
{
    public function located();

    public function scheduled();

    public function unscheduled();

    public function ordered();
}