<?php

namespace app\controllers\backend;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * MaintenanceController allows performing of the the maintenance actions like cache flushing.
 */
class MaintenanceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'flush-cache' => [
                'class' => 'yii2tech\admin\actions\FlushCache',
                'flash' => Yii::t('admin', 'Cache has been flushed.'),
                'returnUrl' => ['index'],
            ],
        ];
    }

    /**
     * Renders maintenance menu.
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}