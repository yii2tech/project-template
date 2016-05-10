<?php

namespace app\models\db;

use Yii;

/**
 * User model
 *
 * @property UserAuthLog[] $authLogs
 */
class User extends Identity
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            // add extra validation here
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            // add extra labels here
        ]);
    }

    // Relations :

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthLogs()
    {
        return $this->hasMany(UserAuthLog::className(), ['userId' => 'id']);
    }

    // Logic :

    /**
     * Sends signup confirmation email.
     * @return boolean success.
     */
    public function sendSignupConfirmEmail()
    {
        return Yii::$app->mailer->compose('signupConfirm', ['user' => $this])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['appEmail'] => Yii::$app->name])
            ->setSubject(Yii::t('auth', 'Confirm Signup at {appName}', ['appName' => Yii::$app->name]))
            ->send();
    }

    /**
     * @inheritdoc
     */
    public function sendSuspendEmail()
    {
        return Yii::$app->mailer->compose('suspendUser', ['admin' => $this])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['appEmail'] => Yii::$app->name])
            ->setSubject(Yii::t('auth', 'Your account at {appName} has been suspended', ['appName' => Yii::$app->name]))
            ->send();
    }
}
