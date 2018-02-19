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
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'flush-cache' => [
                'class' => \yii2tech\admin\actions\FlushCache::class,
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

    /**
     * Triggers sitemap generation as background process.
     */
    public function actionGenerateSitemap()
    {
        $scriptFile = escapeshellarg(Yii::getAlias('@app/yii'));
        exec("php {$scriptFile} sitemap/generate >/dev/null 2>&1 &");

        Yii::$app->session->setFlash('success', Yii::t('admin-content', 'Sitemap generation started. It may take some time to be complete.'));

        return $this->redirect(['index']);
    }
}