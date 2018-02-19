<?php

namespace app\models\db;

use Yii;

/**
 * Admin model
 *
 * @property AdminAuthLog[] $authLogs
 */
class Admin extends Identity
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            // add extra validation here
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            // add extra labels here
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $this->sendNewAdminEmail();
        }
    }

    // Relations :

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthLogs()
    {
        return $this->hasMany(AdminAuthLog::class, ['adminId' => 'id']);
    }

    // Logic :

    /**
     * Sends email notification about account creation.
     * @return boolean success.
     */
    public function sendNewAdminEmail()
    {
        return Yii::$app->mailer->compose('newAdmin', ['admin' => $this])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['appEmail'] => Yii::$app->name])
            ->setSubject(Yii::t('admin', 'Your administration account at {appName}', ['appName' => Yii::$app->name]))
            ->send();
    }

    /**
     * {@inheritdoc}
     */
    public function sendSuspendEmail()
    {
        return Yii::$app->mailer->compose('suspendAdmin', ['admin' => $this])
            ->setTo($this->email)
            ->setFrom([Yii::$app->params['appEmail'] => Yii::$app->name])
            ->setSubject(Yii::t('admin', 'Your administration account at {appName} has been suspended', ['appName' => Yii::$app->name]))
            ->send();
    }
}