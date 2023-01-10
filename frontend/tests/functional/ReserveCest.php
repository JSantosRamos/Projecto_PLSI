<?php


namespace frontend\tests\Functional;

use common\models\User;
use common\models\Vehicle;
use frontend\tests\FunctionalTester;

class ReserveCest
{
    private $idUser;
    private $idReserva;

    public function _before(FunctionalTester $I)
    {
        //user
        $user = new User();

        $user->name = 'Jose';
        $user->username = 'jose';
        $user->email = 'josetesting@test.com';
        $user->password_hash = \Yii::$app->security->generatePasswordHash('jose12345');
        $user->isEmployee = 0;

        $user->save();
        $userlogin = User::findByEmail('josetesting@test.com');
        $this->idUser = $userlogin->id;

        //vehicle
        $vehicle = new Vehicle();
        $vehicle->id = '99';
        $vehicle->brand = 'audi';
        $vehicle->model = 'a3';
        $vehicle->serie = '';
        $vehicle->type ='Desportivo';
        $vehicle->fuel = 'Diesel';
        $vehicle->mileage = '10000';
        $vehicle->engine = 1600;
        $vehicle->color = 'Preto';
        $vehicle->description = 'Bom estado';
        $vehicle->year = '2020';
        $vehicle->doorNumber = 5;
        $vehicle->transmission = 'Manual';
        $vehicle->price = 14000;
        $vehicle->isActive = 1;
        $vehicle->plate = 'TT-99-TR';
        $vehicle->status = 'Disponível';
        $vehicle->title = 'Novo';
        $vehicle->cv = 110;
        $vehicle->idBrand = 4;
        $vehicle->idModel = 5;

        $vehicle->save();



        $I->amLoggedInAs($this->idUser);
        $I->amOnPage('reserve/create?veiculo_id=99');
    }

    // tests
   /* public function addReserva(FunctionalTester $I)
    {
        $I->fillField('Reserve[number]', 910000000);
        $I->fillField('Reserve[nif]', 000111222);
        $I->fillField('Reserve[morada]', 'rua dos testes');
        $I->('Reserve[ccFile]', 'cc.png');
        $I->click('Enviar');
        $I->amOnPage('/site/index');
    }*/
}