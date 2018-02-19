<?php

namespace tests\codeception\frontend\models;

use tests\codeception\fixtures\UserFixture;
use app\models\frontend\SignupForm;

/**
 * SignupFormTest
 *
 * @property \tests\codeception\frontend\UnitTester $tester
 */
class SignupFormTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'some_email@example.com',
            'password' => 'SomePassword1',
            'verifyCode' => 'testme',
        ]);

        $user = $model->signup();

        $this->assertInstanceOf(\app\models\db\User::class, $user, 'user should be valid');

        //expect($user->username)->equals('some_username');
        expect($user->email)->equals('some_email@example.com');
        expect($user->validatePassword('SomePassword1'))->true();
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
            'verifyCode' => 'testme',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('email'))
            ->equals('Email "nicolas.dianna@hotmail.com" has already been taken.');
    }
}