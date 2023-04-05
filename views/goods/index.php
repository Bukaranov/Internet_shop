<?php

use app\models\Goods;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GoodsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Товари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створення товарів', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'description',
            [
                'attribute' => 'category_name',
                'label' => 'Категорія',
                'value' =>  function ($model) {
                return $model->category->name;
                },
            ],
            [
                'attribute' => 'brand_name',
                'label' => 'Бренд',
                'value' =>  function ($model) {
                    return $model->brand->name;
                },
            ],
            [
                'format' => 'html',
                'label' => 'Зображення',
                'value' => function($date)
                {
                    return Html::img($date->getImage(), ['width'=>100]);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Goods $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
