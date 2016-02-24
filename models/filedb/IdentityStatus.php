<?php
/**
 * @link https://github.com/yii2tech
 * @copyright Copyright (c) 2015 Yii2tech
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

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