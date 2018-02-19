<?php

namespace app\models\backend;

use Yii;
use app\models\db\UserAuthLog;

/**
 * UserAuthLogSearch represents the model behind the search form about `app\models\db\UserAuthLog`.
 */
class UserAuthLogSearch extends AuthLogSearch
{
    public $userId;

    /**
     * {@inheritdoc}
     */
    protected $userReferenceAttribute = 'userId';
    /**
     * {@inheritdoc}
     */
    protected $userClass = 'app\models\db\User';


    /**
     * {@inheritdoc}
     */
    protected function createQuery()
    {
        return UserAuthLog::find()->with(['user']);
    }
}
