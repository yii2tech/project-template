<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "AdminAuthLog".
 *
 * @property integer $id
 * @property integer $date
 * @property boolean $cookieBased
 * @property integer $duration
 * @property string $error
 * @property string $ip
 * @property string $host
 * @property string $url
 * @property string $userAgent
 * @property integer $adminId
 *
 * @property Admin $admin
 */
class AdminAuthLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AdminAuthLog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'duration', 'adminId'], 'integer'],
            [['cookieBased'], 'boolean'],
            [['error', 'ip', 'host', 'url', 'userAgent'], 'string', 'max' => 255],
            [['adminId'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::className(), 'targetAttribute' => ['adminId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => Yii::t('common', 'Date'),
            'cookieBased' => Yii::t('auth', 'Cookie Based'),
            'duration' => Yii::t('auth', 'Duration'),
            'error' => Yii::t('yii', 'Error'),
            'ip' => Yii::t('common', 'IP Address'),
            'host' => Yii::t('common', 'Host'),
            'url' => 'URL',
            'userAgent' => Yii::t('auth', 'UserAgent'),
            'adminId' => Yii::t('admin', 'Administrator'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(Admin::className(), ['id' => 'adminId']);
    }
}