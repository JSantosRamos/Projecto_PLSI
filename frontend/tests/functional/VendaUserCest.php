<?php


namespace frontend\tests\Functional;

use common\models\User;
use frontend\tests\FunctionalTester;

class VendaUserCest
{
    public function _before(FunctionalTester $I)
    {

        //user
        $user = new User();

        $user->name = 'Jose';
        $user->username = 'jose';
        $user->email = 'josetesting@test.com';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('jose12345');
        $user->isEmployee = 0;

        $user->save();
        $userlogin = User::findByEmail('josetesting@test.com');
        $id = $userlogin->id;

        $I->amLoggedInAs($id);
        $I->amOnPage('vendauser/create');
    }

    // tests
    public function AddVendauser(FunctionalTester $I)
    {
        $brand = 'Mercedes';
        $plate = 'TT-20-VF';

        $I->fillField('Vendauser[plate]', $plate);
        $I->fillField('Vendauser[mileage]', '100000');
        $I->selectOption('Vendauser[brand]', $brand);
        $I->selectOption('Vendauser[model]', 'Classe C');
        $I->selectOption('Vendauser[fuel]', 'Diesel');
        $I->selectOption('Vendauser[year]', '2022');
        $I->fillField('Vendauser[price]', '44000');
        $I->fillField('Vendauser[description]', 'sem extras');
        $I->click('Enviar');
        $I->amOnPage('/site/index');
    }
}
