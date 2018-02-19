<?php

namespace app\models\frontend;

use app\models\db\User;
use Yii;
use yii\base\Model;
use yii2tech\authlog\AuthLogLoginFormBehavior;

/**
 * LoginForm is the model behind the login form.
 *
 * @method User|null getIdentity()
 *
 * @property User|null $identity identity model instance.
 * @property boolean $isVerifyRobotRequired whether the robot verification required or not.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'authLog' => [
                'class' => AuthLogLoginFormBehavior::class,
                'verifyRobotAttribute' => 'verifyCode',
                'deactivateIdentity' => 'suspend'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['verifyCode', 'safe'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getIdentity();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('auth', 'Incorrect username or password.'));
            } else {
                if (!$user->isActive) {
                    $this->addError($attribute, Yii::t('auth', 'This account is inactive.'));
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('auth', 'Username'),
            'password' => Yii::t('auth', 'Password'),
            'rememberMe' => Yii::t('auth', 'Remember Me'),
            'verifyCode' => Yii::t('common', 'Verification Code'),
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getIdentity(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }
}
