<?php 

use miloschuman\highcharts\HighchartsAsset;

?>

<section id="contenido_principal">
    <?php //Highcharts::widgets([
        //'options'
    //])
    ?>
</section>
<section style="display:none">
    <?php
    $counter = 0;
    foreach($query as $resultado){
        ?> 
        <input name="nombre" value="<?=$resultado['nombre']?>" id="nombre_<?=$counter?>" />
        <input name="vendidos" value="<?=$resultado['vendidos']?>" id="vendidos_<?=$counter?>"/>
    <?php
        $counter += 1;
    } 
    ?>
</section>

<?php
$this->registerJsFile('/js/backoffice-index.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/highcharts.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>