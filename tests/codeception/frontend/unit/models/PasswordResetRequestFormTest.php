<?php

namespace tests\codeception\frontend\models;

use Yii;
use app\models\frontend\PasswordResetRequestForm;
use tests\codeception\fixtures\UserFixture;
use app\models\db\User;

/**
 * PasswordResetRequestFormTest
 *
 * @property \tests\codeception\frontend\UnitTester $tester
 */
class PasswordResetRequestFormTest extends \Codeception\Test\Unit
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

    public function testSendMessageWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect_not($model->send());
    }

    public function testNotSendEmailsToInactiveUser()
    {
        $user = $this->tester->grabFixture('user', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect_not($model->send());
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('user', 0);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = User::findOne(['passwordResetToken' => $userFixture['passwordResetToken']]);

        expect_that($model->send());
        expect_that($user->passwordResetToken);

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($model->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['appEmail']);
    }
}