<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vendauser;

/**
 * VendauserSearch represents the model behind the search form of `common\models\Vendauser`.
 */
class VendauserSearch extends Vendauser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idUser', 'mileage', 'year', 'model', 'serie', 'description'], 'integer'],
            [['price'], 'number'],
            [['reason', 'date', 'plate', 'fuel', 'brand', 'status'], 'safe'],
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
    public function search($params, $originalQuery = true)
    {
        if($originalQuery){
            $query = Vendauser::find();
        }
        else{
            $query = Vendauser::find()->where(['iduser' => \Yii::$app->user->id]);
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
            'idUser' => $this->idUser,
            'price' => $this->price,
            'date' => $this->date,
            'mileage' => $this->mileage,
            'year' => $this->year,
            'model' => $this->model,
            'serie' => $this->serie,
            'description' => $this->description,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason])
            ->andFilterWhere(['like', 'plate', $this->plate])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
