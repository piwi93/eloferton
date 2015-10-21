<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categorias;
use app\models\Temporales;
use app\models\Stock;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = $model->nombre;
?>
<style>
      #map-canvas {
        width: 500px;
        height: 400px;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<div class="productos-view">
    <div class="panel panel-primary  row">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="panel-body">
            
                 <div>
                    <div id="myCarousel" class="carousel slide col-sm-6" data-ride="carousel">
                        <?php 
                            if(count($model->fotos)==0){
                         ?>       
                         <!-- Cuando no tienen imagenes -->
                        <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="active item">
                                <img class="img-responsive center-block" src="/assets/noimgfound.gif" alt="..." style="width:100%;height:100%">
                            </div>
                        </div>
                         <?php   
                        }else{
                        ?>
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php 
                                for($i=1;$i<count($model->fotos);$i++){
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?=$i?>"></li>
                            <?php
                                }
                            ?>
                        </ol>
                        <?php $fotos = $model->fotos;
                            $i=0;
                            foreach($fotos as $foto){
                                $ruta = "/assets/imgOfertas/" . $foto->url;
                                if($i === 0){ ?>
                                    <div class="carousel-inner" role="listbox">
                                    <div class="active item">
                                        
                                        <img class="img-responsive center-block" src="<?= $ruta ?>" alt="Error al cargar imagen" style="width:100%;height:100%">
                                    </div>
                                <?php } else { ?>
                                    <div class="item">
                                        <img class="img-responsive center-block" src="<?= $ruta ?>" alt="Error al cargar imagen" style="width:100%;height:100%">
                                    </div>
                                <?php }
                                $i +=1;
                            }
                        }
                        ?>
                                    </div>
                    </div>
                    <table class="col-sm-6">
                        <tr>
                            <td>
                                Categoría
                            </td>
                            <td>
                                <?= Categorias::findOne($model->categoria)->nombre ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Descripción corta
                            </td>
                            <td>
                                <?= $model->descripcion_corta ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Precio
                            </td>
                            <td>
                                <?= $model->precio ?>
                            </td>
                        </tr>
                        <?php
                            if($model->tipo==2){
                        ?>
                        <tr>
                            <td>
                                Stock
                            </td>
                            <td>
                            <?=
                                $stock->stock    
                            ?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <?php
                            if($model->tipo==1){
                        ?>
                        <tr>
                            <td>
                               Vence el
                            </td>
                            <td>
                            <?=
                                $temporal->fecha    
                            ?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <?php $loggedId = \Yii::$app->user->identity->id;
                                
                                if( isset($loggedId) ){ ?>
                                    <a class="btn btn-primary" href="index.php?r=cupones/generarcupon&id=<?=$model->id ?>" >Comprar</a>
                                <?php } else { ?>
                                    <a class="btn btn-primary" href="index.php?r=site%2Flogin">Login para Comprar</a>
                                <?php } ?>
                                
                            </td>
                        </tr>
                    </table>
                    <hr>
                     <article>
                         <p>Condiciones</p>
                         <p> <?= $model->condiciones ?></p>
                     </article>
                 </div>
                 <section class="col-sm-12">
                     <article>
                         <p>Descripción</p>
                         <p> <?= $model->descripcion_larga ?></p>
                     </article>
                     
                     <hr>
                     <article>
                         <p>Ubicacion</p>
                         <?php
                            if($model->ubicacion == null){
                                ?>No se ha seleccionado ubicación en el mapa 
                                <?php
                            }else{
                         ?>
                         <div id="map-canvas"></div>
                         <?php } ?>
                     </article>
                 </section>
            
        </div>
    </div>
</div>
<?php $ubicacion = $model->ubicacion;
    $arreglo = explode(',', $ubicacion);
    $latitud = explode(':',$arreglo[0]);
    $longitud = explode(':',$arreglo[1]);
?>
<input type='hidden' value='<?= $latitud[1] ?>'  id='latitud'/>
<input type='hidden' value='<?= $longitud[1] ?>' id='longitud' />
<script>
function initialize() {
    var latitud=document.getElementById('latitud').value;
    var longitud=document.getElementById('longitud').value;
    var mapCanvas = document.getElementById('map-canvas');
    var mapOptions = {
      center: new google.maps.LatLng(latitud,longitud),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(mapCanvas,mapOptions);
    google.maps.event.addListener(map, 'click', function( event ){
        document.getElementById('productos-ubicacion').value="Latitud: "+event.latLng.lat()+" "+", Longitud: "+event.latLng.lng();
});
    var marcador = new google.maps.LatLng(latitud,longitud);
    var marker = new google.maps.Marker({
      position: marcador,
      dragabble: false,
      map: map,
      title: ''
  });
  marker.setMap(map);
}


google.maps.event.addDomListener(window, 'load', initialize);

</script>