<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('admin', '{appName} Administration', [
    'appName' => Yii::$app->name,
]);

$blocks = [
    [
        'title' => Yii::t('admin', 'Users'),
        'description' => Yii::t('admin', 'Manage users accounts'),
        'label' => Yii::t('admin', 'Users'),
        'icon' => 'user',
        'url' => ['/user/index'],
    ],
    [
        'title' => Yii::t('admin', 'Administrators'),
        'description' => Yii::t('admin', 'Manage administrator accounts'),
        'label' => Yii::t('admin', 'Administrators'),
        'icon' => 'user',
        'url' => ['/admin/index'],
    ],
];
?>

<?php foreach ($blocks as $number => $block): ?>
    <?php if ($number % 3 == 0): ?>
        <?php if ($number != 0): ?>
    </div>
        <?php endif; ?>
    <div class="row">
    <?php endif; ?>
        <div class="col-lg-4">
            <h3><?= $block['title'] ?></h3>
            <p><?= $block['description'] ?></p>
            <p><?= Html::a(Html::icon($block['icon']) . ' ' . $block['label'], $block['url'], ['class' => 'btn btn-default']) ?></p>
        </div>
<?php endforeach; ?>
