<?php


namespace common\tests\Unit;

use common\models\Vehicle;
use common\tests\UnitTester;

class VehicleTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $id;

    protected function _before()
    {
        //use in test duplicate plate
        $this->tester->haveRecord('common\models\Vehicle', [
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
            'plate' => 'TT-11-PD',
            'status' => 'Disponível',
            'title' => 'Novo audi a3',
            'cv' => 110,
            'idBrand' => 4,
            'idModel' => 5,
        ]);

        $this->id = $this->tester->haveRecord('common\models\Vehicle', [
            'brand' => 'audi',
            'model' => 'a5',
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
            'price' => '50000',
            'isActive' => 0,
            'plate' => 'TT-47-TT',
            'status' => 'Reservado',
            'title' => 'Novo audi a3',
            'idBrand' => 4,
            'idModel' => 5,
        ]);
    }

    // tests
    public function testAddVehicle()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
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
                'plate' => 'TT-50-TA',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'cv' => '106',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );
        $this->assertTrue($vehicle->save());
        $this->tester->seeRecord('common\models\Vehicle', ['plate' => 'TT-50-TA']);
    }

    public function testUpdateVehicle()
    {
        $vehicle = Vehicle::findOne($this->id);
        $vehicle->setAttribute('price', '38000');
        $vehicle->setAttribute('status', 'Vendido');

        $this->assertTrue($vehicle->save());
        $this->assertEquals('38000', $vehicle->price);
        $this->assertEquals('Vendido', $vehicle->status);

        //verify
        $this->tester->seeRecord('common\models\Vehicle', ['status' => 'Vendido']);
    }

    public function testRemoveVehicle()
    {
        $vehicle = Vehicle::findOne($this->id);
        $vehicle->delete();

        $this->tester->dontSeeRecord('common\models\Vehicle', ['plate' => 'TT-47-TT']);
    }

    public function testCanNotAddVehicleMissingPrice()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
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
                'price' => '',
                'isActive' => 0,
                'plate' => '10-TT-20',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );
        $this->assertFalse($vehicle->save());
    }

    public function testCanNotAddVehicleMissingBrandAndModel()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
                'brand' => '',
                'model' => '',
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
                'price' => '',
                'isActive' => 0,
                'plate' => '10-TT-20',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'idBrand' => '',
                'idModel' => '',
            )
        );
        $this->assertFalse($vehicle->save());
    }

    public function testCanNotAddVehicleMissingType()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
                'brand' => 'audi',
                'model' => 'a3',
                'serie' => 's line',
                'type' => '',
                'fuel' => 'Diesel',
                'mileage' => '100000',
                'engine' => 2000,
                'color' => 'Preto',
                'description' => 'Bom estado',
                'year' => 2022,
                'doorNumber' => 5,
                'transmission' => 'Manual',
                'price' => '24000',
                'isActive' => 0,
                'plate' => '10-TT-20',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );
        $this->assertFalse($vehicle->save());
    }

    public function testCanNotAddVehicleMissingMileage()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
                'brand' => 'audi',
                'model' => 'a3',
                'serie' => 's line',
                'type' => 'Desportivo',
                'fuel' => 'Diesel',
                'mileage' => '',
                'engine' => 2000,
                'color' => 'Preto',
                'description' => 'Bom estado',
                'year' => 2022,
                'doorNumber' => 5,
                'transmission' => 'Manual',
                'price' => '',
                'isActive' => 0,
                'plate' => '10-TT-20',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );
        $this->assertFalse($vehicle->save());
    }

    public function testCanNotAddVehicleMissingYear()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
                'brand' => 'audi',
                'model' => 'a3',
                'serie' => 's line',
                'type' => 'Desportivo',
                'fuel' => 'Diesel',
                'mileage' => '60000',
                'engine' => 2000,
                'color' => 'Preto',
                'description' => 'Bom estado',
                'year' => '',
                'doorNumber' => 5,
                'transmission' => 'Manual',
                'price' => '',
                'isActive' => 0,
                'plate' => '10-TT-20',
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );
        $this->assertFalse($vehicle->save());
    }

    public function testDuplicatePlate()
    {
        $vehicle = new Vehicle();
        $vehicle->setAttributes(array(
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
                'plate' => 'TT-11-PD', //already register
                'status' => 'Disponível',
                'title' => 'Novo audi a3',
                'cv' => '106',
                'idBrand' => 4,
                'idModel' => 5,
            )
        );

        $this->assertFalse($vehicle->save());
    }
}

