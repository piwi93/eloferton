<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productos;

/**
 * ProductosSearch represents the model behind the search form about `app\models\Productos`.
 */
class ProductosSearch extends Productos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoria', 'activa', 'vendidos'], 'integer'],
            [['nombre', 'descripcion_corta', 'descripcion_larga', 'tipo', 'condiciones', 'ubicacion'], 'safe'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Productos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'precio' => $this->precio,
            'categoria' => $this->categoria,
            'activa' => $this->activa,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion_corta', $this->descripcion_corta])
            ->andFilterWhere(['like', 'descripcion_larga', $this->descripcion_larga])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'condiciones', $this->condiciones])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion]);

        return $dataProvider;
    }
    
    public function getTop10(){
        $query = (new \yii\db\Query())
            ->select(['nombre', 'vendidos'])
            ->from('productos')
            ->orderBy('vendidos DESC')
            ->limit(10)
            ->all();
        return $query;
    }
}
