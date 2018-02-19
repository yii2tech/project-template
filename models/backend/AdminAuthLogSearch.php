<?php

namespace app\models\backend;

use Yii;
use app\models\db\AdminAuthLog;

/**
 * AdminAuthLogSearch represents the model behind the search form about `app\models\db\AdminAuthLog`.
 */
class AdminAuthLogSearch extends AuthLogSearch
{
    public $adminId;

    /**
     * {@inheritdoc}
     */
    protected $userReferenceAttribute = 'adminId';
    /**
     * {@inheritdoc}
     */
    protected $userClass = 'app\models\db\Admin';


    /**
     * {@inheritdoc}
     */
    protected function createQuery()
    {
        return AdminAuthLog::find()->with(['admin']);
    }
}
