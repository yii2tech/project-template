<?php

namespace tests\codeception\frontend\functional;

use app\models\db\User;
use tests\codeception\frontend\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('signup/index');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[email]'     => 'ttttt',
                'SignupForm[password]'  => 'tester_password',
            ]
        );
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'TesterPassword1',
            'SignupForm[verifyCode]' => 'testme',
        ]);

        $I->seeRecord(User::class, [
            'email' => 'tester.email@example.com',
        ]);

        $I->see('Logout (tester.email@example.com)', 'form button[type=submit]');
    }
}