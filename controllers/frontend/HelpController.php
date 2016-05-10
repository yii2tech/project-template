<?php

namespace app\controllers\frontend;

use app\models\frontend\ContactForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * HelpController
 */
class HelpController extends Controller
{
    public function actionIndex()
    {
        return $this->redirect(['contact']);
    }

    /**
     * Displays contact information with contact form.
     * @return mixed response
     * @throws BadRequestHttpException on invalid request
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post())) {
            if (!Yii::$app->request->isAjax) {
                throw new BadRequestHttpException();
            }
            if ($model->send()) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->renderPartial('_contactForm', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        } else {
            $webUser = Yii::$app->user;
            if (!$webUser->isGuest) {
                /* @var $identity \app\models\db\User */
                $identity = $webUser->identity;
                $model->email = $identity->email;
                $model->name = $identity->fullName;
                if (!empty($identity->phone)) {
                    $model->phone = $identity->phone;
                }
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }
}