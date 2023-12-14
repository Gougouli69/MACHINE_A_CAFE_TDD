<?php

namespace App\Hardware;

interface HardwareInterface {

    public function servirCafe(): int;

    public function registerMoneyDetectedCabllback($callback): void;

}