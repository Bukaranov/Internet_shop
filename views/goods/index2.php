<?php
use app\models\Brands;
use app\models\Categories;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<div class="container">
    <div class="row row-offcanvas row-offcanvas-right">

        <?= $this->render('_nav') ?>

        <div class="col-xs-12 col-sm-9">
            <div class="row">

            <?php foreach ($goods as $good):?>
                    <div class="col-xs-6 col-lg-3">
                        <div class="thumbnail">
                            <a href="<?= Url::toRoute(['goods/single', 'id' => $good->id])?>"><img style="height: 200px; width: 140px;" src="<?= $good->getImage()?>" alt=""></a>
                            <div class="caption jumbotron">
                                <h2><?= $good->name; ?></h2>
                                <h4><?= $good->description; ?></h4>
                            </div>
                                <p><?= $good->price . ' грн.'; ?></p>
                                <p><a href="#" class="btn btn-primary" role="button">Купити</a> <a href="<?= Url::toRoute(['goods/single', 'id' => $good->id])?>" class="btn btn-default" role="button">Информ.</a></p>
                        </div>
                    </div>
            <?php endforeach; ?>
            </div>
            <?= LinkPager::widget([
                'pagination' => $pagination,
            ]) ?>
        </div>
    </div>
</div>






