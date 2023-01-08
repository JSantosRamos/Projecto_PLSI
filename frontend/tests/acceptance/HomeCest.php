<?php

namespace frontend\tests\acceptance;

use common\models\User;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
    }

    public function checkHome(AcceptanceTester $I)
    {
        $I->fillField('LoginForm[email]', 'testinguser@testes.com');
        $I->fillField('LoginForm[password]', 'testinguser');
        $I->see('Login');
        $I->click('login-button');
        $I->wait(1);
        $I->click('Veículos');
        $I->wait(1);
        $I->click('Ver');
        $I->wait(1);
        $I->click('Test-Drive');
        $I->wait(1);
        $I->fillField('Testdrive[date]', '20-01-2023');
        $I->selectOption('Testdrive[time]', '10:00');
        $I->fillField('Testdrive[description]', 'Gosto muito deste carro');
        $I->wait(2);
        $I->click('Enviar');
        $I->wait(5);
        $I->see('O seu Test-dive foi registado, pode acompanhar o processo do mesmo na sua Área Pessoal.');

    }
}
