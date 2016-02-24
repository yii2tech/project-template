<?php
/**
 * @link http://quartsoft.com/
 * @copyright Copyright &copy; 2015 QuartSoft ltd.
 * @license http://www.quartsoft.com/license/
 */

namespace app\controllers\frontend;

use app\models\frontend\PasswordResetRequestForm;
use app\models\frontend\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\frontend\LoginForm;

class AuthController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Login form
     * @return mixed response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout
     * @return mixed response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->send()) {
                Yii::$app->session->setFlash('passwordResetRequestSubmitted', 'Check your email for further instructions.');

                //return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->redirect(Yii::$app->user->loginUrl);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('resetPassword', [
                'model' => $model,
            ]);
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}