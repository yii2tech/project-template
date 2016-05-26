<?php

namespace app\controllers\frontend;

use app\models\frontend\ChangePasswordForm;
use app\models\db\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * AccountController
 */
class AccountController extends Controller
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
     * Renders user dashboard
     * @return mixed response
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * User profile edit form
     * @return mixed response
     */
    public function actionProfile()
    {
        /* @var $model User */
        $model = Yii::$app->user->identity;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('user', 'Your profile has been updated.'));

            return $this->refresh();
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * User change password form
     * @return mixed response
     */
    public function actionPassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->apply()) {
            Yii::$app->session->setFlash('success', Yii::t('user', 'Your profile has been changed.'));

            return $this->refresh();
        }

        return $this->render('password', [
            'model' => $model,
        ]);
    }
}