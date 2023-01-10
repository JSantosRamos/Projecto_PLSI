<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Create user and give him RBAC Role before test
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()

     /**
      * @param FunctionalTester $I
      */

    public function _before(FunctionalTester $I)
    {
        //user admin
        $userAdmin = new User();

        $userAdmin->name = 'Jose';
        $userAdmin->username = 'jose';
        $userAdmin->email = 'josetesting@test.com';
        $userAdmin->password_hash = \Yii::$app->security->generatePasswordHash('jose12345');
        $userAdmin->isEmployee = 1;

        $userAdmin->save();
        $userAdmin = User::findByEmail('josetesting@test.com');
        $idAdmin = $userAdmin->id;

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $idAdmin);

        //user
        $user = new User();

        $user->name = 'Joao';
        $user->username = 'joao';
        $user->email = 'joaotesting@test.com';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('joao12345');
        $user->isEmployee = 0;

        $user->save();

        $I->amOnPage('site/login');
    }

    public function loginUser(FunctionalTester $I)
    {
        $I->see('Preencha os seguintes campos:');
        $I->fillField('LoginForm[email]', 'josetesting@test.com');
        $I->fillField('LoginForm[password]', 'jose12345');
        $I->click('login-button');

        $I->see("STAND AUTO");
    }

    public function loginUserInvalidAccess(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', 'joaotesting@test.com');
        $I->fillField('LoginForm[password]', 'joao12345'); //usertesting
        $I->click('login-button');

        $I->see('Não tem permissões para aceder a esta área!');
    }

    public function loginUserInvalidPassword(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', 'josetesting@test.com');
        $I->fillField('LoginForm[password]', 'erro1234');
        $I->see('Login');
        $I->click('login-button');

        $I->see('Inválido email ou password.');
    }

    public function loginUserInvalidEmpty(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', '');
        $I->fillField('LoginForm[password]', '');
        $I->see('Login');
        $I->click('login-button');

        $I->see('Email cannot be blank.');
        $I->see('Password cannot be blank.');
    }
}
