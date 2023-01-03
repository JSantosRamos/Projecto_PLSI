<?php

namespace common\tests\Unit;

use common\models\User;
use common\tests\UnitTester;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {

    }

    // tests
    public function testCreateUser()
    {
        $user = new User();
        $user->setAttributes(array(
                'name' => 'Name userteste',
                'username' => 'usernameteste',
                'auth_key' => \Yii::$app->security->generateRandomString(),
                'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
                'created_at' => '1402312317',
                'updated_at' => '1402312317',
                'email' => 'user12345@gmail.com',
                'isEmployee' => 0,
                'status' => 10)
        );
        $this->assertTrue($user->save());
        $this->tester->seeRecord('common\models\User', ['email' => 'user12345@gmail.com']);
    }

    public function testUpdateEmail()
    {
        //create user
        $id = $this->tester->haveRecord('common\models\User', [
            'username' => 'user2',
            'email' => 'userteste2@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'Name user',
        ]);

        //user
        $user = User::findOne($id);
        $user->setAttribute('email', 'userteste2000@gmail.com');
        $this->assertTrue($user->save());
        $this->assertEquals('userteste2000@gmail.com', $user->email);

        //verify
        $this->tester->seeRecord('common\models\User', ['email' => 'userteste2000@gmail.com']);
        $this->tester->dontSeeRecord('common\models\User', ['email' => 'userteste2@gmail.com']);
    }

    public function testUpdateUserName()
    {
        //create user
        $id = $this->tester->haveRecord('common\models\User', [
            'username' => 'user2',
            'email' => 'user2@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'Name user',
        ]);

        //user
        $user = User::findOne($id);
        $user->setAttribute('username', 'user2000');
        $this->assertTrue($user->save());
        $this->assertEquals('user2000', $user->username);

        //verify
        $this->tester->seeRecord('common\models\User', ['username' => 'user2000']);
        $this->tester->dontSeeRecord('common\models\User', ['username' => 'username2']);

    }

    public function testUpdatePassword()
    {
        //create user
        $oldPwd = \Yii::$app->security->generatePasswordHash('user12345');

        $id = $this->tester->haveRecord('common\models\User', [
            'username' => 'user2',
            'email' => 'user2@gmail.com',
            'password_hash' => $oldPwd,
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'joser',
        ]);

        //user
        $user = User::findOne($id);
        $newPwd = \Yii::$app->security->generatePasswordHash('passwordteste123');

        $user->setAttribute('password_hash', $newPwd);
        $this->assertTrue($user->save());
        $this->assertEquals($newPwd, $user->password_hash);

        //verify
        $this->tester->seeRecord('common\models\User', ['password_hash' => $newPwd]);
        $this->tester->dontSeeRecord('common\models\User', ['password_hash' => $oldPwd]);

    }

    public function testDeleteUser()
    {
        $id = $this->tester->haveRecord('common\models\User', [
            'username' => 'user2',
            'email' => 'user2@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'joser',
        ]);

        $user = User::findOne($id);
        $user->delete();

        $this->tester->dontSeeRecord(User::class, ['username' => 'user2']);
    }

    public function testCanNotCreateMissingEmail(){
        $user = new User();
        $user->setAttributes(array(
                'name' => 'joser',
                'username' => 'usertest',
                'auth_key' => \Yii::$app->security->generateRandomString(),
                'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
                'created_at' => '1402312317',
                'updated_at' => '1402312317',
                'email' => '',
                'isEmployee' => 0,
                'status' => 10)
        );
        $this->assertFalse($user->save());
    }

    public function testCanNotCreateMissingPassword(){
        $user = new User();
        $user->setAttributes(array(
                'name' => 'joser',
                'username' => 'usertest',
                'auth_key' => \Yii::$app->security->generateRandomString(),
                'password_hash' => '',
                'created_at' => '1402312317',
                'updated_at' => '1402312317',
                'email' => '',
                'isEmployee' => 0,
                'status' => 10)
        );
        $this->assertFalse($user->save());
    }
}
