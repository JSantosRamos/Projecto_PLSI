<?php


namespace frontend\tests\Functional;

use frontend\tests\FunctionalTester;

class TestDriveCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(96);
        $I->amOnPage('/');
    }

    // tests
    public function TestDrive(FunctionalTester $I)
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
