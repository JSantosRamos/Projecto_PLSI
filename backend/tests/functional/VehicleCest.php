<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;

class VehicleCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(96);
        $I->amOnPage('/');

        $I->haveRecord('common\models\Vehicle', array(
            'id' => 99,
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
            'plate' => '10-TT-55',
            'status' => 'Vendido',
            'title' => 'Novo audi a3',
            'cv' => 110,
            'idBrand' => 4,
            'idModel' => 5,));
    }

    // tests
    public function AddVehicle(FunctionalTester $I)
    {
        $plate = '57-TT-40';

        $I->click('Veículos');
        $I->click('Adicionar');
        $I->fillField('Vehicle[title]', 'Novo Audi A5');
        $I->fillField('Vehicle[description]', 'O novo audi A5 com equipamento s-line');
        $I->fillField('Vehicle[plate]', $plate);
        $I->selectOption('Vehicle[idBrand]', 'Audi');
        $I->selectOption('Vehicle[idModel]', 'A5');
        $I->selectOption('Vehicle[type]', 'Utilitário');
        $I->selectOption('Vehicle[fuel]', 'Diesel');
        $I->fillField('Vehicle[mileage]', '60000');
        $I->fillField('Vehicle[engine]', '2000');
        $I->selectOption('Vehicle[color]', 'Preto');
        $I->fillField('Vehicle[year]', '2020');
        $I->fillField('Vehicle[doorNumber]', '5');
        $I->selectOption('Vehicle[transmission]', 'Manual');
        $I->fillField('Vehicle[price]', '34000');
        $I->fillField('Vehicle[cv]', '110');
        $I->selectOption('Vehicle[status]', 'Disponível');
        $I->checkOption('#vehicle-isactive');

        $I->click('Guardar');
        $I->see('Editar Veículo: (' . $plate . ')', 'h1');
    }

    public function UpdateVehicle(FunctionalTester $I)
    {
        $newPlate = '11-TT-55'; //record in _before()

        $I->amOnPage('vehicle/view?id=99');
        $I->click('Editar');
        $I->fillField('Vehicle[plate]', $newPlate);
        $I->click('Guardar');
        $I->see('Editar Veículo: (' . $newPlate . ')', 'h1');
    }
}
