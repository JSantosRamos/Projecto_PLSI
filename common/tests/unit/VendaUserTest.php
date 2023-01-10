<?php


namespace common\tests\Unit;

use common\models\Vendauser;
use common\tests\UnitTester;

class VendaUserTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    public $idUser;

    protected function _before()
    {
        $this->idUser = $this->tester->haveRecord('common\models\User', [
            'username' => 'jose',
            'email' => 'jose@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('jose12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'nameuser2',
        ]);
    }

    // tests
    public function testAddVendaUser()
    {
        $vendauser = new Vendauser();
        $vendauser->setAttributes(array(
                'date' => '24-02-2023',
                'plate' => '00-TT-98',
                'mileage' => '100000',
                'idUser' => $this->idUser,
                'status' => 'Por ver',
                'fuel' => 'Gasolina',
                'year' => '2022',
                'brand' => 'Mercedes',
                'model' => 'A',
                'serie' => '',
                'price' => '30000'
            )
        );

        $this->assertTrue($vendauser->save());
        $this->tester->seeRecord('common\models\Vendauser', ['plate' => '00-TT-98']);
    }

    public function testUpdateVendaUser()
    {
        $id = $this->tester->haveRecord('common\models\Vendauser', [
            'date' => '24-01-2023',
            'plate' => '00-TT-98',
            'mileage' => '100000',
            'idUser' => $this->idUser,
            'status' => 'Por ver',
            'fuel' => 'Gasolina',
            'year' => '2022',
            'brand' => 'Mercedes',
            'model' => 'A',
            'serie' => '',
            'price' => '30000',
        ]);

        $vendauser = Vendauser::findOne($id);
        $vendauser->setAttribute('status', 'Recusado');

        $this->assertTrue($vendauser->save());
        $this->assertEquals('Recusado', $vendauser->status);

        //verify
        $this->tester->seeRecord('common\models\Vendauser', ['status' => 'Recusado', 'id' => $id]);
        $this->tester->dontSeeRecord('common\models\Vendauser', ['status' => 'Por ver', 'id' => $id]);

    }

    public function testRemoveVendaUser()
    {
        $id = $this->tester->haveRecord('common\models\Vendauser', [
            'date' => '24-01-2023',
            'plate' => '00-AA-98',
            'mileage' => '100000',
            'idUser' => $this->idUser,
            'status' => 'Por ver',
            'fuel' => 'Gasolina',
            'year' => '2022',
            'brand' => 'Mercedes',
            'model' => 'A',
            'serie' => '',
            'price' => '30000',
        ]);

        $testDrive = Vendauser::findOne($id);
        $testDrive->delete();

        $this->tester->dontSeeRecord('common\models\Vendauser', ['id' => $id]);
    }

    public function testCanNotAddVendaMissingPrice()
    {
        $testDrive = new Vendauser();
        $testDrive->setAttributes(array(
                'date' => '24-01-2023',
                'plate' => '00-AA-98',
                'mileage' => '100000',
                'idUser' => $this->idUser,
                'status' => 'Por ver',
                'fuel' => 'Gasolina',
                'year' => '2022',
                'brand' => 'Mercedes',
                'model' => 'A',
                'serie' => '',
                'price' => '',
            )
        );

        $this->assertFalse($testDrive->save());
    }

    public function testCanNotAddVendaUserMissingPlate()
    {
        $testDrive = new Vendauser();
        $testDrive->setAttributes(array(
                'date' => '24-01-2023',
                'plate' => '',
                'mileage' => '100000',
                'idUser' => $this->idUser,
                'status' => 'Por ver',
                'fuel' => 'Gasolina',
                'year' => '2022',
                'brand' => 'Mercedes',
                'model' => 'A',
                'serie' => '',
                'price' => '25000',
            )
        );

        $this->assertFalse($testDrive->save());
    }
}
