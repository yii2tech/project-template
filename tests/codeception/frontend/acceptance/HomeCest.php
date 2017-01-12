<?php

namespace tests\codeception\frontend\acceptance;

use Yii;
use tests\codeception\frontend\AcceptanceTester;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Yii::$app->homeUrl);
        $I->see('MyProject');

        $I->seeLink('About');
        $I->click('About');
        $I->wait(2); // wait for page to be opened

        $I->see('This is the About page.');
    }
}