<?php

namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

/**
 * Admin fixture
 */
class AdminFixture extends ActiveFixture
{
    public $modelClass = 'app\models\db\Admin';
}