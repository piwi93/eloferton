<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fotos".
 *
 * @property string $id
 * @property string $idProducto
 * @property string $url
 *
 * @property Productos $idProducto0
 */
class Fotos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProducto', 'url'], 'required'],
            [['idProducto'], 'integer'],
            [['url'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idProducto' => 'Id Producto',
            'url' => 'Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto0()
    {
        return $this->hasOne(Productos::className(), ['id' => 'idProducto']);
    }
    
    public function deleteFoto($foto){
        $file_name = $foto->url;
        $file = 'assets/imgOfertas/' . $file_name;
        if(file_exists($file)){
            unlink($file);
        }
        $foto->delete();
    }
}
