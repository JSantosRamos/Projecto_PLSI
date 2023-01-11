<?php


namespace backend\tests\Functional;

use backend\tests\FunctionalTester;
use common\models\User;

class VehicleCest
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

        $I->amOnPage('vehicle/create');

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
            'plate' => 'TT-02-TT',
            'status' => 'Vendido',
            'title' => 'Novo audi a3',
            'cv' => 110,
            'idBrand' => 4,
            'idModel' => 5,));
    }

    // tests
    public function AddVehicle(FunctionalTester $I)
    {
        $plate = 'TT-01-TT';

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
        $I->selectOption('Vehicle[year]', '2020');
        $I->fillField('Vehicle[doorNumber]', '5');
        $I->selectOption('Vehicle[transmission]', 'Manual');
        $I->fillField('Vehicle[price]', '34000');
        $I->fillField('Vehicle[cv]', '110');
        $I->selectOption('Vehicle[status]', 'Disponível');
        $I->checkOption('#vehicle-isactive');

        $I->click('Guardar');
        $I->see('Veículo:' . $plate, 'h1');
    }

    public function UpdateVehicle(FunctionalTester $I)
    {
        $newPlate = 'TT-03-TT'; //record in _before()

        $I->amOnPage('/vehicle/update?id=99');
        $I->fillField('Vehicle[plate]', $newPlate);
        $I->click('Guardar');
        $I->see('Veículo:' . $newPlate, 'h1');
    }
}
