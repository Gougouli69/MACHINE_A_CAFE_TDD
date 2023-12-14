<?php

use App\Classes\Amount;
use App\Classes\CoffeeMachine;

describe('Machine a café', function () {
    it("ETANT DONNE une machine à café
    QUAND on insère au moins le prix d'un café
    ALORS un café est servi
    ET l'argent est encaissé", function ($money) {
        // Etant donné une machine a café
        $machineACafe = new CoffeeMachine($money);

        // Quand on insère au moins le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();

        // Alors un café est servi
        $caféServi = $machineACafe->coffeeServed();

        // Et l'argent est encaissé
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($caféServi)->toBeTrue();
        expect($argentEncaissé)->toBeTrue();
        expect($argentInséréEstValide)->toBeTrue();
    })->with([Amount::FIFTY_CENTS, Amount::ONE_EURO, Amount::TWO_EUROS]);

    it("ETANT DONNE une machine à café
    QUAND on insère moins que le prix d'un café
    ALORS aucun café n'est servi
    ET l'argent est rendu", function ($money) {
        // Etant donné une machine a café
        $machineACafe = new CoffeeMachine($money);

        // QUAND on insère moins que le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();

        // Alors un café est servi
        $caféServi = $machineACafe->coffeeServed();

        // Et l'argent est encaissé
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($caféServi)->toBeFalse();
        expect($argentEncaissé)->toBeFalse();
        expect($argentInséréEstValide)->toBeFalse();
    })->with([Amount::ONE_CENT, Amount::TWO_CENTS, Amount::FIVE_CENTS, Amount::TEN_CENTS, Amount::TWENTY_CENTS]);
});

