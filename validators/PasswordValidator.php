<?php

namespace app\validators;

use Yii;
use yii\base\Model;
use yii\validators\Validator;

/**
 * PasswordValidator validates if given password is strong enough.
 *
 * @package app\validators
 */
class PasswordValidator extends Validator
{
    /**
     * @var Validator[] list of slave validators
     */
    private $_validators;


    /**
     * @return Validator[] list of slave validators
     */
    private function getValidators()
    {
        if ($this->_validators === null) {
            $this->_validators = $this->createValidators();
        }
        return $this->_validators;
    }

    /**
     * @return Validator[] list of validators
     */
    private function createValidators()
    {
        $model = new Model();
        return [
            static::createValidator('string', $model, $this->attributes, ['min' => 6]),
            static::createValidator('match', $model, $this->attributes, [
                'pattern' => '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/s',
                'message' => Yii::t('error', '{attribute} is too weak.'),
            ]),
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function validateValue($value)
    {
        foreach ($this->getValidators() as $validator) {
            $result = $validator->validateValue($value);
            if (!empty($result)) {
                return $result;
            }
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $validations = [];
        foreach ($this->getValidators() as $validator) {
            $validations[] = $validator->clientValidateAttribute($model, $attribute, $view);
        }
        return implode(' ', $validations);
    }
}