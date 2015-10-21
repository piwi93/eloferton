<?php
use yii\helpers\Url;
use app\models\productos;

/* @var $this \yii\web\View */

$this->title = 'Resultado de búsqueda';
?>

<div id="searchresult" class="col-xs-12">
    <?php 
        if(count($model)==0){
            ?><div style="margin-top:25%"><center><h3>No se han enconrado elementos</h3></center></div><?php
        }
        else{
            $element = 0;
            foreach($model as $oferta){
                if($element % 3 == 0){ ?>
                    <div class="row"> <?php
                }
            ?>
                <div class="col-sm-4">
                    <a class="producto col-sm-12" href = <?= Url::to(['productos/verproducto', 'id' => $oferta->id])?>>
                        <div class="row">
                            <?php $fotos = $oferta->getFotos();
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
                                <strong><?= $oferta->nombre ?></strong>
                                <p><?= $oferta->descripcion_corta ?></p>
                                <p>Precio: <strong>$<?=$oferta->precio?></strong></p>
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
        } ?>
</div>