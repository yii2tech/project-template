<?php

namespace app\models\frontend;

use app\models\db\User;
use app\validators\PasswordValidator;
use yii\base\Model;
use Yii;
use yii\captcha\CaptchaValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class],

            ['password', 'required'],
            ['password', PasswordValidator::class],

            ['verifyCode', CaptchaValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('common', 'Email'),
            'password' => Yii::t('auth', 'Password'),
            'verifyCode' => Yii::t('common', 'Verification Code'),
        ];
    }

    /**
     * Signs user up.
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before signup the user.
     * @return User|null the saved model or null if saving fails
     */
    public function signup($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            return null;
        }

        $user = new User();
        $user->email = $this->email;
        $user->password = $this->password;
        $user->statusId = User::STATUS_ACTIVE;
        if ($user->save(false)) {
            $user->sendNewUserEmail();
            return $user;
        }

        return null;
    }
}