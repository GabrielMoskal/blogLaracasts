<?php

namespace app\Billing;


class Stripe
{

    private $key;

    /**
     * Stripe constructor.
     */
    public function __construct($key)
    {
        $this->key = $key;
    }
}