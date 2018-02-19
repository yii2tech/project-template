<?php

namespace app\controllers\backend;

use yii2tech\admin\CrudController;
use yii\helpers\ArrayHelper;
use yii2tech\admin\behaviors\ContextModelControlBehavior;

/**
 * UserController implements the CRUD actions for [[app\models\db\User]] model.
 * @see app\models\db\User
 */
class UserController extends CrudController
{
    /**
     * {@inheritdoc}
     */
    public $modelClass = \app\models\db\User::class;
    /**
     * {@inheritdoc}
     */
    public $searchModelClass = \app\models\backend\UserSearch::class;


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        $actions = parent::actions();

        unset($actions['create']);

        return ArrayHelper::merge($actions, [
            'suspend' => [
                'class' => \yii2tech\admin\actions\Callback::class,
                'callback' => 'suspend'
            ],
            'activate' => [
                'class' => \yii2tech\admin\actions\Callback::class,
                'callback' => 'activate'
            ],
        ]);
    }
}
