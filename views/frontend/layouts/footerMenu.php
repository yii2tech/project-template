<?php

use yii\helpers\Url;
use yii\widgets\Menu;
use app\models\filedb\Language;

/* @var $this \yii\web\View */

echo Menu::widget([
    'id' => 'footer-menu',
    'options' => [
        'class' => 'list-inline',
    ],
    //'firstItemCssClass' => 'first',
    //'lastItemCssClass' => 'last',
    'items' => [
        ['label' => Yii::t('menu', 'About'), 'url' => ['/site/about']],
        ['label' => Yii::t('menu', 'F.A.Q.'), 'url' => ['/help/faq']],
        ['label' => Yii::t('menu', 'Contact'), 'url' => ['/help/contact']],
    ],
]);
?>