<?php

namespace tests\codeception\frontend\unit\models;

use tests\codeception\frontend\unit\DbTestCase;
use tests\codeception\fixtures\UserFixture;
use Codeception\Specify;
use app\models\frontend\SignupForm;

class SignupFormTest extends DbTestCase
{
    use Specify;

    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'some_email@example.com',
            'password' => 'SomePassword1',
            'verifyCode' => 'testme',
        ]);

        $user = $model->signup();

        $this->assertInstanceOf('app\models\db\User', $user, 'user should be valid');

        //expect('username should be correct', $user->username)->equals('some_username');
        expect('email should be correct', $user->email)->equals('some_email@example.com');
        expect('password should be correct', $user->validatePassword('SomePassword1'))->true();
    }

    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'email' => 'nicolas.dianna@hotmail.com',
            'password' => 'some_password',
            'verifyCode' => 'testme',
        ]);

        expect('username and email are in use, user should not be created', $model->signup())->null();
    }

    public function fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/frontend/unit/fixtures/data/models/user.php',
            ],
        ];
    }
}
