<?php

namespace App\Classes;

class CoffeeMachine {

    const COFFEE_PRICE = 50;
    const NOTWORK_STATE = false; 
    const WORK_STATE = true;

    private Order $order;

    public function __construct(
        private bool $state = self::WORK_STATE,
        private int $coffeeServed = 0,
        private int $amountCashed = 0
    ) {
    }

    public function createOrder($amount) : void {
        $this->order = new Order($amount);
    }

    public function coffeeServed(): bool 
    {
        if($this->getState() && $this->order->getIsPaid()){
            $this->coffeeServed++;
            $this->amountCashed+= $this->order->getAmount();
        }
        return false;
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

    public function getAmountCashed(): int {
        return $this->amountCashed;
    }

}