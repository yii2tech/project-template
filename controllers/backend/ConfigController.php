<?php

namespace app\controllers\backend;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * ConfigController handles application configuration.
 */
class ConfigController extends Controller
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
     * Performs batch updated of application configuration records.
     */
    public function actionIndex()
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');

        $models = $configManager->getItems();

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            $configManager->saveValues();
            Yii::$app->session->setFlash('success', Yii::t('admin', 'Configuration updated.'));
            return $this->refresh();
        }

        return $this->render('index', [
            'models' => $models,
        ]);
    }

    /**
     * Restores default values for the application configuration.
     */
    public function actionDefault()
    {
        /* @var $configManager \yii2tech\config\Manager */
        $configManager = Yii::$app->get('configManager');
        $configManager->clearValues();
        Yii::$app->session->setFlash('success', Yii::t('admin', 'Default values restored.'));
        return $this->redirect(['index']);
    }
}