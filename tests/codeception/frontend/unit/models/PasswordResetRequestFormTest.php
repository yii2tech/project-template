<?php

namespace tests\codeception\frontend\models;

use Yii;
use tests\codeception\frontend\unit\DbTestCase;
use app\models\frontend\PasswordResetRequestForm;
use tests\codeception\fixtures\UserFixture;
use app\models\db\User;
use Codeception\Specify;

class PasswordResetRequestFormTest extends DbTestCase
{
    use Specify;

    protected function setUp()
    {
        parent::setUp();

        Yii::$app->mailer->fileTransportCallback = function ($mailer, $message) {
            return 'testing_message.eml';
        };
    }

    protected function tearDown()
    {
        if (file_exists($messageFile = $this->getMessageFile())) {
            unlink($messageFile);
        }

        parent::tearDown();
    }

    public function testSendEmailWrongUser()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect('no user with such email, message should not be sent', $model->send())->false();

        $model = new PasswordResetRequestForm();
        $model->email = $this->user[1]['email'];
        expect('user is not active, message should not be sent', $model->send())->false();
    }

    public function testSendEmailCorrectUser()
    {
        $model = new PasswordResetRequestForm();
        $model->email = $this->user[0]['email'];
        $user = User::findOne(['passwordResetToken' => $this->user[0]['passwordResetToken']]);

        expect('email sent', $model->send())->true();
        expect('user has valid token', $user->passwordResetToken)->notNull();

        expect('message file exists', file_exists($this->getMessageFile()))->true();

        $message = file_get_contents($this->getMessageFile());
        expect('message "from" is correct', $message)->contains(Yii::$app->params['appEmail']);
        expect('message "to" is correct', $message)->contains($model->email);
    }

    public function fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/frontend/unit/fixtures/data/models/user.php'
            ],
        ];
    }

    private function getMessageFile()
    {
        return Yii::getAlias(Yii::$app->mailer->fileTransportPath) . '/testing_message.eml';
    }
}
