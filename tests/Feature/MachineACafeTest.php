<?php

use App\Classes\Amount;
use App\Classes\CoffeeMachine;

describe('Machine a café', function () {
    it("ETANT DONNE une machine à café
    QUAND on insère au moins le prix d'un café
    ALORS un café est servi
    ET l'argent est encaissé", function ($argentInséré) {
        // Etant donné une machine a café
        $machineACafe = new CoffeeMachine();
        $machineACafe->createOrder($argentInséré);

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
    ET l'argent est rendu", function ($argentInséré) {
        // Etant donné une machine a café
        $machineACafe = new CoffeeMachine();
        $machineACafe->createOrder($argentInséré);

        // QUAND on insère moins que le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();

        // ALORS aucun café n'est servi
        $caféServi = $machineACafe->coffeeServed();

        // ET l'argent est rendu
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($caféServi)->toBeFalse();
        expect($argentEncaissé)->toBeFalse();
        expect($argentInséréEstValide)->toBeFalse();
    })->with([Amount::ONE_CENT, Amount::TWO_CENTS, Amount::FIVE_CENTS, Amount::TEN_CENTS, Amount::TWENTY_CENTS]);

    it("ETANT DONNE une machine a café ne pouvant pas servir
    QUAND on insère au moins le prix d'un café
    ALORS aucun café n'est servi
    ET l'argent est rendu", function ($argentInséré) {
        // ETANT DONNE une machine a café ne pouvant pas servir
        $state = CoffeeMachine::WORK_STATE;
        $machineACafe = new CoffeeMachine($state);
        $machineACafe->createOrder($argentInséré);

        // QUAND on insère au moins le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();

        // ALORS aucun café n'est servi
        $caféServi = $machineACafe->coffeeServed();

        // ET l'argent est rendu
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($caféServi)->toBeFalse();
        expect($argentEncaissé)->toBeFalse();
        expect($argentInséréEstValide)->toBeFalse();
    })->with([Amount::ONE_CENT, Amount::TWO_CENTS, Amount::FIVE_CENTS, Amount::TEN_CENTS, Amount::TWENTY_CENTS]);

    it("J'ai de l'argent et je veux un café, j'ai pas d'argent et je veux un café, j'ai de l'argent et je veux un café", function () {
        
        //? Commande n°1
        // ETANT DONNE une machine a café pouvant servir
        $state = CoffeeMachine::WORK_STATE;
        $machineACafe = new CoffeeMachine($state);
        $machineACafe->createOrder(Amount::ONE_EURO);

        // QUAND on insère au moins le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();
        
        // La machine peut servir 
        $etatDeLaMachine = $machineACafe->getState();

        // ALORS aucun café n'est servi
        $caféServi = $machineACafe->coffeeServed();

        // ET l'argent est rendu
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($argentInséréEstValide)->toBeTrue();
        expect($etatDeLaMachine)->toBeTrue();
        expect($caféServi)->toBeTrue();
        expect($argentEncaissé)->toBeTrue();

        //? Commande n°2
        // ETANT DONNE une machine a café pouvant servir
        $machineACafe->createOrder(Amount::TEN_CENTS);

        // QUAND on insère au moins le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();
        
        // La machine peut servir 
        $etatDeLaMachine = $machineACafe->getState();

        // ALORS aucun café n'est servi
        $caféServi = $machineACafe->coffeeServed();

        // ET l'argent est rendu
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($argentInséréEstValide)->toBeFalse();        
        expect($etatDeLaMachine)->toBeTrue();
        expect($caféServi)->toBeFalse();
        expect($argentEncaissé)->toBeFalse();

        
        //? Commande n°3
        // ETANT DONNE une machine a café pouvant servir
        $machineACafe->createOrder(Amount::FIFTY_CENTS);

        // QUAND on insère au moins le prix d'un café
        $argentInséréEstValide = $machineACafe->isInsertedMoneyValid();
        
        // La machine peut servir 
        $etatDeLaMachine = $machineACafe->getState();
        
        // ALORS aucun café n'est servi
        $caféServi = $machineACafe->coffeeServed();

        // ET l'argent est rendu
        $argentEncaissé = $machineACafe->cashedMoney();

        expect($argentInséréEstValide)->toBeTrue();
        expect($etatDeLaMachine)->toBeTrue();
        expect($caféServi)->toBeTrue();
        expect($argentEncaissé)->toBeTrue();


    });
});

