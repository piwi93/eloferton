<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use app\models\Categorias;
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
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('/assets/oferton_logo.png', ['alt'=>Yii::$app->name, 'style' => 'max-height:50px']),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-fixed-top',
                    'style' => 'background-color:white',
                ],
            ]);
            
            echo '<div class="col-lg-offset-1 col-sm-5 col-md-5 col-lg-6">
            
                    <form class="navbar-form" role="search" method="post" action="index.php?r=site/search">
                        <div class="input-group" style="width:100%;">
                            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                            <input type="text" class="form-control" placeholder="Buscar oferta" name="nombre">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                 </div>';
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right navbar-collapse col-sm-5 col-md-5'],
                'items' => [
                    ['label' => 'Inicio', 'url' => ['/site/index']],
                    ['label' => 'Mi Perfil', 'url' => ['/usuario/view/'], 'visible' => Yii::$app->user->isGuest ? false : true ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Iniciar sesión', 'url' => ['/site/login']] :
                        ['label' => 'Cerrar sesión (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ['label' => 'Registrarse', 'url' => ['/site/sign_in'], 'visible' => Yii::$app->user->isGuest ? true : false ],
                ],
            ]);
            NavBar::end();
        ?>
        <div class="container body-content">
           
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            
                <div class="col-sm-3 col-lg-2" id="menu" style:"margin-top:60px; position:relative">
                    <div class="list-group" id="categorias" style="width:100%">
                
                    <?php
                    foreach(Categorias::find()->All() as $cate){
                        ?>
                        <a  href=<?= Url::to(['categorias/ofertas', 'id' => $cate->id])?> class="list-group-item"><?= $cate->nombre ?></a>
                         
                        <?php
                    }
                    ?>
                    </div>
                </div>
            <div class="col-sm-9 col-lg-10">
               <?= $content ?> 
            </div>
            
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <a href="index.php?r=site/about" class="pull-right">Sobre nosotros</a>
            <label class="pull-right">|</label>
            <a href="index.php?r=site/contact" class="pull-right">Contactenos</a>
            <p class="pull-left">&copy; PHP El oferton - Aquino, Nicolas - Becco, Diego - Laporta, Emanuel </p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
