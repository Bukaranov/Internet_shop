<?php

use app\models\Brands;
use app\models\Categories;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Goods $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Categories::find()->all(), 'id', 'name'),[
        'prompt' => [
            'text' => 'Виберіть категорію',
            'options'=> ['disabled' => true, 'selected' => true],
            ]
        ])
    ?>

    <?= $form->field($model, 'brand_id')->dropDownList(ArrayHelper::map(Brands::find()->all(), 'id', 'name'),[
        'prompt' => [
            'text' => 'Виберіть бренд',
            'options'=> ['disabled' => true, 'selected' => true],
        ]
    ])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Зберегти', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
