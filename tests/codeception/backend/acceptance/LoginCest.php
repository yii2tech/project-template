<?php

namespace tests\codeception\backend\acceptance;

use tests\codeception\backend\AcceptanceTester;
use tests\codeception\fixtures\AdminFixture;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->haveFixtures([
            'admin' => [
                'class' => AdminFixture::class,
                'dataFile' => codecept_data_dir() . 'admin.php'
            ]
        ]);
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(AcceptanceTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(AcceptanceTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkValidLogin(AcceptanceTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin4test', 'password_0'));
        $I->see('admin4test', 'a[class=dropdown-toggle]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}