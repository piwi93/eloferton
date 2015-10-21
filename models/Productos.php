<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion_corta
 * @property string $descripcion_larga
 * @property double $precio
 * @property tipo $tipo
 * @property string $categoria
 * @property string $condiciones
 * @property string $ubicacion
 * @property integer $activa
 *
 * @property Cupones[] $cupones
 * @property Fotos[] $fotos
 * @property Categorias $categoria0
 * @property Stock $stock
 * @property Temporales $temporales
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion_corta', 'descripcion_larga', 'precio', 'tipo', 'categoria', 'condiciones', 'ubicacion', 'activa'], 'required'],
            [['precio'], 'number'],
            [['categoria', 'activa'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion_corta'], 'string', 'max' => 100],
            [['descripcion_larga'], 'string', 'max' => 300],
            [['tipo'], 'string', 'max' => 30],
            [['condiciones'], 'string', 'max' => 2000],
            [['ubicacion'], 'string', 'max' => 255]
        ];
    }
    


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion_corta' => 'Descripcion Corta',
            'descripcion_larga' => 'Descripcion Larga',
            'precio' => 'Precio',
            'tipo' => 'Tipo',
            'categoria' => 'Categoria',
            'condiciones' => 'Condiciones',
            'ubicacion' => 'Ubicacion',
            'activa' => 'Activa',
            'vendidos' => 'Productos vendidos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCupones()
    {
        return $this->hasMany(Cupones::className(), ['idproducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotos()
    {
        return $this->hasMany(Fotos::className(), ['idProducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria0()
    {
        return $this->hasOne(Categorias::className(), ['id' => 'categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['idproducto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemporales()
    {
        return $this->hasOne(Temporales::className(), ['idproducto' => 'id']);
    }
    public function getActivaLabel()
    {
        return $this->activa ? 'Activada' : 'Desactivada';
    }
    public function getTipoLabel()
    {
        $tipo = $this->tipo;
        if ($tipo == 0){
            return 'Normal';
        }
        elseif($tipo == 1){
            return 'Por tiempo';
        }
        else{
            return 'Hasta agotar stcok';
        }
        //return $this->tipo==0 ? 'Normal' : $this->tipo == 1 ? 'Por tiempo' : 'Hasta agotar stock';
    }
}

