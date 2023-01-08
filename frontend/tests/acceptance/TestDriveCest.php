<?php

namespace frontend\tests\Acceptance;

use frontend\tests\AcceptanceTester;

class TestDriveCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amLoggedInAs(58);
        $I->amOnPage('/');
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->click('Veículos');
        $I->click('Ver mais');
        $I->click('#testdrive_book');
        $I->fillField('Testdrive[date]', '20-01-2023');
        $I->selectOption('Testdrive[time]', '10:00');
        $I->fillField('Testdrive[description]', 'Gosto muito deste carro');
        $I->click('Enviar');
        $I->see('O seu Test-dive foi registado, pode acompanhar o processo do mesmo na sua Área Pessoal.');
    }
}
