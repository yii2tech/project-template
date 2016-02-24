<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Html;
use yii2tech\admin\widgets\ButtonContextMenu;
?>
<?php $this->beginContent($this->findViewFile('/layouts/overall')); ?>
<div class="<?= str_replace('/', '-', $this->context->action->getUniqueId()) ?>">
    <h1><?= Html::encode(isset($this->params['header']) ? $this->params['header'] : $this->title) ?></h1>

    <p>
        <?= ButtonContextMenu::widget([
            'items' => isset($this->params['contextMenuItems']) ? $this->params['contextMenuItems'] : []
        ]) ?>
    </p>

<?= $content ?>
</div>
<?php $this->endContent(); ?>