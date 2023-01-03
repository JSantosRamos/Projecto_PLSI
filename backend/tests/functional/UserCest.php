<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;

class UserCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(96);
        $I->amOnPage('/');
    }

    // tests
    public function AddUser(FunctionalTester $I)
    {
        $name = 'Teste';

        $I->click('Utilizadores');
        $I->click('Adicionar');
        $I->fillField('User[name]', $name);
        $I->fillField('User[username]', 'teste123');
        $I->fillField('User[email]', 'teste123@gmail.com');
        $I->fillField('User[password_hash]', 'teste12345');
        $I->fillField('User[nif]', '054783433');
        $I->fillField('User[number]', '914783403');
        $I->selectOption('User[status]', 'Ativo');

        $I->click('Guardar');
        $I->see($name, 'h1');
    }
}
