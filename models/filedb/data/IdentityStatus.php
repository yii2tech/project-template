<?php
/**
 * @see app\models\filedb\IdentityStatus
 */

use app\models\db\Identity;

return [
    Identity::STATUS_ACTIVE => [
        'name' => 'Active'
    ],
    Identity::STATUS_SUSPENDED => [
        'name' => 'Suspended'
    ],
    Identity::STATUS_PENDING => [
        'name' => 'Pending'
    ],
    Identity::STATUS_DELETED => [
        'name' => 'Deleted'
    ],
];