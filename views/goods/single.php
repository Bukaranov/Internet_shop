<?php

$this->title = $goods->name;
$this->params['breadcrumbs'][] = $this->title;

?>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="col-xs-6 col-lg-5">
                        <div class="thumbnail">
                           <img style="height: 360px; width: 250px;" src="<?= $goods->getImage(); ?>" alt="">
                        </div>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <div class="col-xs-6 col-lg-6">
                                <div class="thumbnail">
                                    <div class="caption jumbotron">
                                        <h2><?= $goods->name; ?></h2>
                                    </div>
                                    <h4>Опис:</h4>
                                    <h5><?= $goods->description; ?></h5>
                                    <hr>
                                    <p><h4>Ціна - <?= $goods->price . ' грн.'; ?></h4></p>
                                    <p><a href="#" class="btn btn-primary" role="button">Купити</a></p>
                                </div>
                            </div>
                        </header>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->