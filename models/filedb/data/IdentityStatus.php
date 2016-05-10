<?php
/**
 * @see app\models\filedb\IdentityStatus
 */

use app\models\db\Identity;

return [
    Identity::STATUS_ACTIVE => [
        'name' => Yii::t('status', 'Active')
    ],
    Identity::STATUS_SUSPENDED => [
        'name' => Yii::t('status', 'Suspended')
    ],
    Identity::STATUS_PENDING => [
        'name' => Yii::t('status', 'Pending')
    ],
    Identity::STATUS_DELETED => [
        'name' => Yii::t('status', 'Deleted')
    ],
];