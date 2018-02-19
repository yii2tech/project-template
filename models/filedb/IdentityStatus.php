<?php

namespace app\models\filedb;

use yii2tech\filedb\ActiveRecord;

/**
 * IdentityStatus
 *
 * @property int $id
 * @property string $name
 */
class IdentityStatus extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function fileName()
    {
        return 'IdentityStatus';
    }
}