<?php

namespace tests\codeception\frontend\models;

use tests\codeception\fixtures\UserFixture;
use app\models\frontend\ResetPasswordForm;

/**
 * ResetPasswordFormTest
 *
 * @property \tests\codeception\frontend\UnitTester $tester
 */
class ResetPasswordFormTest extends \Codeception\Test\Unit
{
    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
        ]);
    }

    public function testResetWrongToken()
    {
        $this->tester->expectException('yii\base\InvalidArgumentException', function() {
            new ResetPasswordForm('');
        });

        $this->tester->expectException('yii\base\InvalidArgumentException', function() {
            new ResetPasswordForm('notexistingtoken_1391882543');
        });
    }

    public function testResetCorrectToken()
    {
        $user = $this->tester->grabFixture('user', 0);
        $form = new ResetPasswordForm($user['passwordResetToken']);
        expect_that($form->resetPassword());
    }
}