<?php

namespace app\controllers\backend;

use yii2tech\admin\CrudController;
use yii\helpers\ArrayHelper;
use yii2tech\admin\behaviors\ContextModelControlBehavior;

/**
 * AdminAuthLogController implements the CRUD actions for [[app\models\db\AdminAuthLog]] model.
 * @see app\models\db\AdminAuthLog
 */
class AdminAuthLogController extends CrudController
{
    /**
     * {@inheritdoc}
     */
    public $modelClass = \app\models\db\AdminAuthLog::class;
    /**
     * {@inheritdoc}
     */
    public $searchModelClass = \app\models\backend\AdminAuthLogSearch::class;
    /**
     * Contexts configuration
     * @see ContextModelControlBehavior::contexts
     */
    public $contexts = [
        // Specify actual contexts :
        'admin' => [
            'class' => \app\models\db\Admin::class,
            'attribute' => 'adminId',
            'controller' => 'admin',
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
