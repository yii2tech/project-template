<?php

namespace app\models\frontend;

use app\models\db\Admin;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha', 'skipOnEmpty' => !Yii::$app->user->isGuest],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('common', 'Name'),
            'subject' => Yii::t('common', 'Subject'),
            'body' => Yii::t('common', 'Body'),
            'email' => Yii::t('common', 'Email'),
            'verifyCode' => Yii::t('common', 'Verification Code'),
        ];
    }

    /**
     * Sends an email to the application administrators using the information collected by this model.
     * @return boolean whether the model passes validation
     */
    public function send()
    {
        if ($this->validate()) {
            foreach (Admin::find()->all() as $admin) {
                /* @var $admin Admin */
                Yii::$app->mailer->compose('contact', ['form' => $this, 'admin' => $admin])
                    ->setTo($admin->email)
                    ->setFrom([Yii::$app->params['appEmail'] => Yii::$app->name])
                    ->setSubject(Yii::t('help', '{appName} Contact Inquiry: {subject}', ['appName' => Yii::$app->name, 'subject' => $this->subject]))
                    ->send();
            }

            return true;
        }
        return false;
    }
}
