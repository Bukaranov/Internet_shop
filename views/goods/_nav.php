<?php

use app\models\Brands;
use app\models\Categories;
use yii\bootstrap\Nav;

?>

<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">

    <h5>Ктегоріі</h5>

    <?= Nav::widget([
        'items' => Categories::getCategoriesLinks(),
        'options' => ['class' => 'navbar navbar-default'],
    ]);
    ?>

    <h5>Бренди</h5>

    <?= Nav::widget([
        'items' => Brands::getBrandsLinks(),
        'options' => ['class' => 'navbar navbar-default'],
    ]);
    ?>
</div><!--/.sidebar-offcanvas-->