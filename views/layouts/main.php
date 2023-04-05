<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Головна сторінка',
        'brandUrl' => '/goods/index2',
        'options' => ['class' => 'navbar navbar-inverse']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav position-right'],
        'items' => [
            [
                'label' => 'Товари',
                'url' => ['/goods/index'],
//                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isUser
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin

            ],
            [
                'label' => 'Категорії',
                'url' => ['/categories/index'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin

            ],
            [
                'label' => 'Бренди',
                'url' => ['/brands/index'],
                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin

            ],
            Yii::$app->user->isGuest ? (
            [
                    'label' => 'Авторизуватися',
                'url' => ['/users/login']
            ]) : (
                '<li>'
                . Html::beginForm(['/users/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            [
                'label' => 'Реєстрація',
                'url' => ['/users/signup'],
                'visible' => Yii::$app->user->isGuest
            ]
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
