<?php

namespace App\Classes;

class CoffeeMachine {

    public function __construct(
        private $amount
    ) {
    }

    public function coffeeServed(): bool 
    {
        return $this->isInsertedMoneyValid();
    }

    public function cashedMoney(): bool 
    {
        return $this->coffeeServed();
    }

    public function isInsertedMoneyValid(): bool
    {
        return $this->amount >= Amount::FIFTY_CENTS && 
        in_array($this->amount, [
            Amount::FIFTY_CENTS,
            Amount::ONE_EURO,
            Amount::TWO_EUROS
        ]);
    }

}