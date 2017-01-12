<?php

namespace tests\codeception\frontend\acceptance;

use tests\codeception\frontend\AcceptanceTester;

class AboutCest
{
    public function checkAbout(AcceptanceTester $I)
    {
        $I->amOnRoute('site/about');
        $I->see('About', 'h1');
    }
}