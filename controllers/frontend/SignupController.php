<?php

namespace app\controllers\frontend;

use app\models\frontend\SignupForm;
use Yii;
use yii\base\Exception;
use yii\web\Controller;

/**
 * SignupController provides the user signup functionality.
 */
class SignupController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
            return false;
        }
        return parent::beforeAction($action);
    }

    /**
     * Signs user up, using regular workflow.
     * @return mixed response
     */
    public function actionIndex()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if (($user = $model->signup()) !== null) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}