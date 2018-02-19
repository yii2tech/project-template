<?php

namespace app\controllers\backend;

use yii2tech\admin\CrudController;
use yii\helpers\ArrayHelper;
use yii2tech\admin\behaviors\ContextModelControlBehavior;

/**
 * UserAuthLogController implements the CRUD actions for [[app\models\db\UserAuthLog]] model.
 * @see app\models\db\UserAuthLog
 */
class UserAuthLogController extends CrudController
{
    /**
     * {@inheritdoc}
     */
    public $modelClass = \app\models\db\UserAuthLog::class;
    /**
     * {@inheritdoc}
     */
    public $searchModelClass = \app\models\backend\UserAuthLogSearch::class;
    /**
     * Contexts configuration
     * @see ContextModelControlBehavior::contexts
     */
    public $contexts = [
        // Specify actual contexts :
        'user' => [
            'class' => \app\models\db\User::class,
            'attribute' => 'userId',
            'controller' => 'user',
            'required' => false,
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'model' => [
                    'class' => ContextModelControlBehavior::class,
                    'contexts' => $this->contexts
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        return $actions;
    }
}
