<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Brands $model */

$this->title = 'Створюйте бренди';
$this->params['breadcrumbs'][] = ['label' => 'Бренди', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
