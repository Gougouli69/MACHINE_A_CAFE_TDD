<?php

namespace App\Classes;

class CoffeeMachine {

    const NOTWORK_STATE = false; 
    const WORK_STATE = true;

    private Order $order;

    public function __construct(
        private bool $state = self::WORK_STATE,
    ) {
    }

    public function createOrder($amount) : void {
        $this->order = new Order($amount);
    }

    public function coffeeServed(): bool 
    {
        return $this->getState() && $this->order->getIsPaid();
    }

    public function cashedMoney(): bool 
    {
        return $this->coffeeServed();
    }

    public function isInsertedMoneyValid(): bool
    {
        $isInsertedMoneyValid = $this->order->getAmount() >= Amount::FIFTY_CENTS && 
        in_array($this->order->getAmount(), [
            Amount::FIFTY_CENTS,
            Amount::ONE_EURO,
            Amount::TWO_EUROS
        ]);
        if($isInsertedMoneyValid)
            $this->order->setIsPaid(true);
        
        return $isInsertedMoneyValid;
    }

    public function setState($state): void {
        $this->state = $state;
    }

    public function getState(): bool {
        return $this->state;
    }

}