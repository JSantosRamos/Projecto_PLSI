<?php

namespace common\tests\Unit;

use common\models\User;
use common\tests\UnitTester;

class UserTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $id;

    protected function _before()
    {
       $this->id = $this->tester->haveRecord('common\models\User', [
            'username' => 'joao',
            'email' => 'joao@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('joao12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'Name Joao',
        ]);
    }

    // tests
    public function testCreateUser()
    {
        $user = new User();
        $user->setAttributes(array(
                'name' => 'Jose',
                'username' => 'jose',
                'auth_key' => \Yii::$app->security->generateRandomString(),
                'password_hash' => \Yii::$app->security->generatePasswordHash('jose12345'),
                'created_at' => '1402312317',
                'updated_at' => '1402312317',
                'email' => 'jose@gmail.com',
                'isEmployee' => 0,
                'status' => 10)
        );
        $this->assertTrue($user->save());
        $this->tester->seeRecord('common\models\User', ['email' => 'jose@gmail.com']);
    }

    public function testUpdateEmail()
    {
        $user = User::findOne($this->id);
        $user->setAttribute('email', 'user2000@gmail.com');
        $this->assertTrue($user->save());
        $this->assertEquals('user2000@gmail.com', $user->email);

        //verify
        $this->tester->seeRecord('common\models\User', ['email' => 'user2000@gmail.com']);
        $this->tester->dontSeeRecord('common\models\User', ['email' => 'joao@gmail.com']);
    }

    public function testUpdateUserName()
    {
        $user = User::findOne($this->id);
        $user->setAttribute('username', 'user2000');
        $this->assertTrue($user->save());
        $this->assertEquals('user2000', $user->username);

        //verify
        $this->tester->seeRecord('common\models\User', ['username' => 'user2000']);
        $this->tester->dontSeeRecord('common\models\User', ['username' => 'joao']);

    }

    public function testUpdatePassword()
    {
        //create user
        $oldPwd = \Yii::$app->security->generatePasswordHash('joao12345');

        $user = User::findOne($this->id);
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
        $user = User::findOne($this->id);
        $user->delete();

        $this->tester->dontSeeRecord(User::class, ['username' => 'joao']);
        $this->tester->dontSeeRecord(User::class, ['username' => 'user2000']);
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
