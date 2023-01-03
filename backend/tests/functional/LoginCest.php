<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /*
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
   /* public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */

    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
    }

    public function loginUser(FunctionalTester $I)
    {
        $I->see('Please fill out the following fields to login:');
        $I->fillField('LoginForm[email]', 'adminteste@gmail.com');
        $I->fillField('LoginForm[password]', 'adminteste123');
        $I->click('login-button');

        $I->see("STAND AUTO");
    }

    public function loginUserInvalidAccess(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', 'user@gmail.com');
        $I->fillField('LoginForm[password]', 'user1234');
        $I->see('Login');
        $I->click('login-button');

        $I->see('Não tem permissões para aceder a esta área!');
    }

    public function loginUserInvalid(FunctionalTester $I)
    {
        $I->fillField('LoginForm[email]', 'user@gmail.com');
        $I->fillField('LoginForm[password]', 'user4321');
        $I->see('Login');
        $I->click('login-button');

        $I->see('Incorrect username or password.');
    }
}
