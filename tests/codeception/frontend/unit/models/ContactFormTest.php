<?php

namespace tests\codeception\frontend\models;

use Yii;
use app\models\frontend\ContactForm;

/**
 * ContactFormTest
 *
 * @property \tests\codeception\frontend\UnitTester $tester
 */
class ContactFormTest extends \Codeception\Test\Unit
{
    public function testSendEmail()
    {
        $model = new ContactForm();

        $model->attributes = [
            'name' => 'Tester',
            'email' => 'tester@example.com',
            'subject' => 'very important letter subject',
            'body' => 'body of current message',
            'verifyCode' => 'testme',
        ];

        expect_that($model->send());

        // using Yii2 module actions to check email was sent
        $this->tester->seeEmailIsSent();

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        //expect($emailMessage->getTo())->hasKey('admin@example.com');
        //expect($emailMessage->getFrom())->hasKey('tester@example.com');
        expect($emailMessage->getSubject())->contains('very important letter subject');
        expect($emailMessage->toString())->contains('body of current message');
        expect($emailMessage->toString())->contains('Tester');
        expect($emailMessage->toString())->contains('tester@example.com');
    }
}