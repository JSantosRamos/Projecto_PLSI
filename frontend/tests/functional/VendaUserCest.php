<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class VendaUserCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(96);
        $I->amOnPage('/');
    }

    // tests
    public function AddVendauser(FunctionalTester $I)
    {

        $brand = 'Mercedes';
        $plate = '20-TT-60';

        $I->click('#vendacarro');
        $I->fillField('Vendauser[plate]', $plate);
        $I->fillField('Vendauser[mileage]', '100000');
        $I->selectOption('Vendauser[brand]', $brand);
        $I->selectOption('Vendauser[model]', 'Classe C');
        $I->selectOption('Vendauser[fuel]', 'Diesel');
        $I->selectOption('Vendauser[year]', '2018');
        $I->fillField('Vendauser[price]', '44000');
        $I->fillField('Vendauser[description]', 'sem extras');
        $I->click('Enviar');
        $I->see('Proposta de venda: ' . $brand.'('.$plate.')', 'h1');
    }
}
