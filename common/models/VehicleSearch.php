<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vehicle;

/**
 * VehicleSearch represents the model behind the search form of `common\models\Vehicle`.
 */
class VehicleSearch extends Vehicle
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'engine', 'year', 'doorNumber', 'isActive'], 'integer'],
            [['brand', 'model', 'serie', 'type', 'fuel', 'mileage', 'color', 'description', 'transmission', 'image', 'title', 'plate'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $frontendview = false)
    {
        if($frontendview){
            $query = Vehicle::find()->where(['isActive' => 1]);
        }else{
            $query = Vehicle::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'engine' => $this->engine,
            'year' => $this->year,
            'doorNumber' => $this->doorNumber,
            'price' => $this->price,
            'isActive' => $this->isActive,
        ]);

        $query->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'plate', $this->plate]);

        return $dataProvider;
    }
}
