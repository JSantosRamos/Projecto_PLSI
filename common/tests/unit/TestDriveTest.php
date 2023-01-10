<?php


namespace common\tests\Unit;

use common\models\Testdrive;
use common\tests\UnitTester;

class TestDriveTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;

    protected function _before()
    {
        $this->idUser = $this->tester->haveRecord('common\models\User', [
            'username' => 'jose',
            'email' => 'jose@gmail.com',
            'password_hash' => \Yii::$app->security->generatePasswordHash('user12345'),
            'isEmployee' => 0,
            'status' => 10,
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'name' => 'jose',
        ]);

        $this->idVehicle = $this->tester->haveRecord('common\models\Vehicle', [
            'brand' => 'audi',
            'model' => 'a3',
            'serie' => 's line',
            'type' => 'Desportivo',
            'fuel' => 'Diesel',
            'mileage' => '100000',
            'engine' => 2000,
            'color' => 'Preto',
            'description' => 'Bom estado',
            'year' => 2022,
            'doorNumber' => 5,
            'transmission' => 'Manual',
            'price' => '40000',
            'isActive' => 0,
            'plate' => 'AA-00-CC',
            'status' => 'Disponível',
            'title' => 'Novo audi a3',
            'cv' => 110,
            'idBrand' => 4,
            'idModel' => 5,
        ]);
    }

    // tests
    public function testAddTestDrive()
    {
        $testDrive = new Testdrive();
        $testDrive->setAttributes(array(
                'date' => '20-02-2023',
                'time' => '12:00',
                'description' => 'Procuro um carro novo',
                'idUser' => $this->idUser,
                'idVehicle' => $this->idVehicle,
                'status' => 'Por ver',
            )
        );

        $this->assertTrue($testDrive->save());
        $this->tester->seeRecord('common\models\TestDrive', ['idVehicle' => $this->idVehicle]);
    }

    public function testUpdateTestDrive()
    {
        $id = $this->tester->haveRecord('common\models\Testdrive', [
            'date' => '20-02-2023',
            'time' => '14:00',
            'description' => 'Procuro um carro novo',
            'idUser' => $this->idUser,
            'idVehicle' => $this->idVehicle,
            'status' => 'Por ver',
        ]);

        $testDrive = Testdrive::findOne($id);
        $testDrive->setAttribute('status', 'Aceite');

        $this->assertTrue($testDrive->save());
        $this->assertEquals('Aceite', $testDrive->status);

        //verify
        $this->tester->seeRecord('common\models\TestDrive', ['status' => 'Aceite']);
        $this->tester->dontSeeRecord('common\models\Vehicle', ['status' => 'Por ver']);

    }

    public function testRemoveTestDrive()
    {
        $id = $this->tester->haveRecord('common\models\Testdrive', [
            'date' => '20-02-2023',
            'time' => '12:00',
            'description' => 'Procuro um carro novo',
            'idUser' => $this->idUser,
            'idVehicle' => $this->idVehicle,
            'status' => 'Por ver',
        ]);

        $testDrive = Testdrive::findOne($id);
        $testDrive->delete();

        $this->tester->dontSeeRecord('common\models\Testdrive', ['id' => $id]);
    }

    public function testCanNotAddTestDriveMissingDate()
    {
        $testDrive = new Testdrive();
        $testDrive->setAttributes(array(
                'date' => '',
                'time' => '12:00',
                'description' => 'Procuro um carro novo',
                'idUser' => $this->idUser,
                'idVehicle' => $this->idVehicle,
                'status' => 'Por ver',
            )
        );

        $this->assertFalse($testDrive->save());
    }

    public function testCanNotAddTestDriveMissingHour()
    {
        $testDrive = new Testdrive();
        $testDrive->setAttributes(array(
                'date' => '20-02-2023',
                'time' => '',
                'description' => 'Procuro um carro novo',
                'idUser' => $this->idUser,
                'idVehicle' => $this->idVehicle,
                'status' => 'Por ver',
            )
        );

        $this->assertFalse($testDrive->save());
    }
}
