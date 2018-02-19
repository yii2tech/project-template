<?php

namespace app\models\frontend;

use app\models\db\Identity;
use app\validators\PasswordValidator;
use Yii;
use yii\base\Model;

/**
 * ChangePasswordForm serves for the user password change.
 *
 * @property Identity $user
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $password;
    public $passwordRepeat;

    /**
     * @var Identity
     */
    private $_user;


    /**
     * @return Identity
     */
    public function getUser()
    {
        if (!is_object($this->_user)) {
            $this->_user = Yii::$app->user->identity;
        }
        return $this->_user;
    }

    /**
     * @param Identity|null $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['oldPassword', 'required'],
            ['oldPassword', 'validateOldPassword'],

            ['password', 'required'],
            ['password', PasswordValidator::class],

            ['passwordRepeat', 'required'],
            ['passwordRepeat', PasswordValidator::class],

            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Validates the old password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors($attribute)) {
            if (!$this->getUser()->validatePassword($this->{$attribute})) {
                $this->addError($attribute, Yii::t('auth', 'Incorrect password.'));
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => Yii::t('auth', 'Old Password'),
            'password' => Yii::t('auth', 'Password'),
            'passwordRepeat' => Yii::t('auth', 'Repeat Password'),
        ];
    }

    /**
     * Applies new user password.
     * @return boolean success
     */
    public function apply()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->password = $this->password;
            return $user->save(false);
        }
        return false;
    }
}