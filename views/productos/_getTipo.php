<?php 
    if($model == 1){
        ?>
        <!--<div class="form-group">
            <label for="tipo">Fecha inicio</label>
            <input type="date" class="form-control" name="fechaIn"/>
        </div>-->
        <label>Fecha de publicación</label>
        <div class="form-group required">
            <div class='input-group date' id='datetimepicker'>
                <input class="form-control" type="text" name="fecha" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar">
                    </span>
                </span>
            </div>
            <div class="help-block"></div>
        </div>
        <?php
    }else if($model == 2){
        ?>
        <div class="form-group">
            <label for="tipo">Cantidad</label>
            <input type="number" class="form-control" name="cant"/>
        </div>
        <?php
    }
?>