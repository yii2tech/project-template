<?php

namespace app\models\frontend;

use app\models\db\Admin;
use app\validators\PhoneValidator;
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
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('contact', 'Name'),
            'subject' => Yii::t('contact', 'Subject'),
            'body' => Yii::t('contact', 'Body'),
            'email' => Yii::t('contact', 'Email'),
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
                    ->setSubject(Yii::t('help', '{appName} Contact Inquiry: {subject}', ['appName' => Yii::$app->name, 'subject' => $this->subject], $admin->languageId))
                    ->send();
            }

            return true;
        }
        return false;
    }
}