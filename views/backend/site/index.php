<?php
/**
 * @see \app\controllers\backend\SiteController::actionIndex()
 */

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('admin', '{appName} Administration', [
    'appName' => Yii::$app->name,
]);

$blocks = [
    [
        'title' => Yii::t('admin', 'Application Configuration'),
        'description' => Yii::t('admin-content', 'Setup application name, email etc.'),
        'label' => Yii::t('admin', 'Application Configuration'),
        'icon' => 'cog',
        'url' => ['/config/index'],
    ],
    [
        'title' => Yii::t('admin', 'Maintenance'),
        'description' => Yii::t('admin-content', 'Maintenance: flush cache, etc.'),
        'label' => Yii::t('admin', 'Maintenance'),
        'icon' => 'wrench',
        'url' => ['/maintenance/index'],
    ],
    [
        'title' => Yii::t('admin', 'Administrators'),
        'description' => Yii::t('admin-content', 'Manage administrator accounts'),
        'label' => Yii::t('admin', 'Administrators'),
        'icon' => 'user',
        'url' => ['/admin/index'],
    ],
    [
        'title' => Yii::t('admin', 'Users'),
        'description' => Yii::t('admin-content', 'Manage users accounts'),
        'label' => Yii::t('admin', 'Users'),
        'icon' => 'user',
        'url' => ['/user/index'],
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
