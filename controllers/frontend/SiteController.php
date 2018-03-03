<?php

namespace app\controllers\frontend;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'captcha' => [
                '__class' => \yii\captcha\CaptchaAction::class,
                'driver' => [
                    '__class' => \yii\captcha\ImagickDriver::class,
                ],
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'error' => [
                '__class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays home page
     * @return mixed response
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays information about the project
     * @return mixed response.
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * This action should respond to 'robots.txt' request.
     * It will create its content "on the fly", taking in account current environment.
     */
    public function actionRobots()
    {
        $disallow = YII_ENV_PROD ? '' : "\nDisallow: /";
        $siteMapUrl = Yii::$app->urlManager->getHostInfo() . Yii::$app->urlManager->getBaseUrl() . '/sitemap/sitemap.xml';

        $content = <<<ROBOTS
User-agent: *{$disallow}

Sitemap: {$siteMapUrl}
ROBOTS;
        $response = Yii::$app->getResponse();
        $response->format = Response::FORMAT_RAW;
        $response->getHeaders()->add('Content-Type', 'text/plain; charset=UTF-8');
        $response->content = $content;
        return $response;
    }
}
