<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\User;

class UserCest
{
    public function _before(FunctionalTester $I)
    {

        //user admin
        $user = new User();

        $user->name = 'Jose';
        $user->username = 'jose';
        $user->email = 'josetesting2@test.com';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('jose12345');
        $user->isEmployee = 1;

        $user->save();
        $user = User::findByEmail('josetesting2@test.com');
        $id = $user->id;

        $auth = \Yii::$app->authManager;
        $authorRole = $auth->getRole('admin');
        $auth->assign($authorRole, $id);

        $I->amLoggedInAs($id);
        $I->amOnPage('user/create');
    }

    // tests
    public function AddUser(FunctionalTester $I)
    {
        $name = 'myname';

        $I->fillField('User[name]', $name);
        $I->fillField('User[username]', 'myname123');
        $I->fillField('User[email]', 'myname@test.com');
        $I->selectOption('User[status]', 'Ativo');

        $I->click('Guardar');
        $I->see($name, 'h1');
    }
}
