<?php

namespace App\Classes;

class Order {


    public function __construct(
        private int $amount,
        private bool $is_paid = false
    ) {}

    public function getAmount(): int {
        return $this->amount;
    }

    public function getIsPaid(): bool {
        return $this->is_paid;
    }    
    
    public function setIsPaid($bool): void {
        $this->is_paid = $bool;
    }
}