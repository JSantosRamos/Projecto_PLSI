<?php

namespace frontendtests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnRoute(\Yii::$app->homeUrl);
        $I->see('Stand Auto');
        $I->seeLink('Veículos');
        $I->click('Veículos');
        $I->see('Procurar por');
    }
}