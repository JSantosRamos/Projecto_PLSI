<?php

namespace frontend\tests\acceptance;

use common\models\User;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class TestdriveCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
    }

    public function AddTestdrive(AcceptanceTester $I)
    {
        $I->fillField('LoginForm[email]', 'admin@gmail.com');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->see('Login');
        $I->click('login-button');
        $I->wait(3);
        $I->click('Veículos');
        $I->wait(1);
        $I->click('Ver');
        $I->wait(1);
        $I->click('Test-Drive');
        $I->wait(1);
        $I->fillField('Testdrive[date]', '20-02-2023');
        $I->selectOption('Testdrive[time]', '10:00');
        $I->fillField('Testdrive[description]', 'Gosto muito deste carro');
        $I->wait(2);
        $I->click('Enviar');
        $I->wait(5);
        $I->see('O seu Test-dive foi registado, pode acompanhar o processo do mesmo na sua Área Pessoal.');
    }
}
