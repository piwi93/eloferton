<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="icono_oferton2.ico" type="image/x-icon" />
    
    <link rel="stylesheet" href="/css/main.css" type="text/css"/>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'EL OFERTON',
                'brandUrl' => array("site/backoffice"),
                'options' => [
                    'class' => 'navbar-inverse navbar-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Inicio', 'url' => ['/site/backoffice']],
                    ['label' => 'Ofertas', 'url' => ['/productos/index']],
                    ['label' => 'Categorias', 'url' => ['/categorias/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Iniciar sesión', 'url' => ['/site/login']] :
                        ['label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
            NavBar::end();
        ?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; PHP El oferton - Aquino, Nicolas - Becco, Diego - Laporta, Emanuel </p>
        </div>
    </footer>
    
<?php $this->endBody() ?>
    <script type="text/javascript" src="/js/backoffice.js"></script>
</body>
</html>
<?php $this->endPage() ?>

