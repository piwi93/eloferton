<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'El Oferton';
?>

          <link rel="stylesheet" href="./css/normalize.css">
       <!--   <link rel="stylesheet" href="./css/foundation.css"> -->
          <link rel="stylesheet" href="./css/site.css">
        
        <div class='row col-xs-12' id="index-header">
            <div id="header_ofertas_dia">
                <canvas id='restante' width="400" height="40"  ></canvas>
            </div>
            
        </div>
        
          <div class="row">
            <div class="large-12 columns">
              
         <?php
            $element = 0;
            foreach($model as $oferta){
                if($element % 3 == 0){ ?>
                    <div class="row"> <?php
                }
            ?>
                <div class="col-sm-4">
                    <a class="col-sm-12" href = <?= Url::to(['productos/verproducto', 'id' => $oferta->getIdproducto0()->one()->id])?>>
                        <div class="row">
                            <?php $fotos = $oferta->getIdproducto0()->one()->getFotos();
                                if($fotos->count() == 0){
                                    ?> <img src="/assets/noimgfound.gif" alt="Error al cargar imagen" style="width:100%;height:100%"/><?php
                                }
                                else{
                                    $ruta = "/assets/imgOfertas/" . $fotos->one()->url;
                                    ?> <img src="<?=$ruta?>" alt="Error al cargar imagen" style="width:100%;height:100%"/>
                                <?php } ?>
                        </div>
                        <div class="row" >
                            <div class="well" style="width:100%;height:100%">
                                <strong><?= $oferta->getIdproducto0()->one()->nombre ?></strong>
                                <p><?= $oferta->getIdproducto0()->one()->descripcion_corta ?></p>
                                <p>Precio: <strong>$<?=$oferta->getIdproducto0()->one()->precio?></strong></p>
                            </div>
                        </div>
                    </a>
                    
                </div>
               <?php
                if($element % 3 == 2){ ?>
                    </div> <?php
                }
            $element += 1;
            }
        ?>
          </div>
          </div>
<?php
$this->registerJsFile('/js/frontoffice.js', ['depends' => [yii\web\JqueryAsset::className()]]);

?>
<script>

</script>