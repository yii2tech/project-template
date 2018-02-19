<?php

namespace app\controllers\frontend;

use app\models\frontend\ContactForm;
use Yii;
use yii\web\Controller;

/**
 * HelpController handles pages and actions dedicated to the user assistance and feedback.
 */
class HelpController extends Controller
{
    /**
     * Mail help page.
     * @return mixed response
     */
    public function actionIndex()
    {
        return $this->redirect(['contact']);
    }

    /**
     * Displays contact page.
     * @return mixed response
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('success', Yii::t('help', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            return $this->refresh();
        }

        $webUser = Yii::$app->user;
        if (!$webUser->isGuest) {
            /* @var $identity \app\models\db\User */
            $identity = $webUser->identity;
            $model->email = $identity->email;
            $model->name = $identity->username;
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays 'Frequently asked questions' section.
     * @return mixed response.
     */
    public function actionFaq()
    {
        return $this->render('faq');
    }
}