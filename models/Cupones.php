<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cupones".
 *
 * @property integer $id
 * @property string $idusuario
 * @property string $idproducto
 * @property string $fecha
 *
 * @property Productos $idproducto0
 * @property Usuario $idusuario0
 */
class Cupones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cupones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idusuario', 'idproducto', 'fecha'], 'required'],
            [['idusuario', 'idproducto'], 'integer'],
            [['fecha'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idusuario' => 'Idusuario',
            'idproducto' => 'Idproducto',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdproducto0()
    {
        return $this->hasOne(Productos::className(), ['id' => 'idproducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdusuario0()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'idusuario']);
    }
}
