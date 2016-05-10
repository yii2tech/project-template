<?php

namespace app\models\filedb;

use yii2tech\filedb\ActiveRecord;

/**
 * IdentityStatus
 *
 * @property integer $id
 * @property string $name
 *
 * @author Paul Klimov <pklimov@quartsoft.com>
 * @package app\models\filedb
 */
class IdentityStatus extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function fileName()
    {
        return 'IdentityStatus';
    }
}