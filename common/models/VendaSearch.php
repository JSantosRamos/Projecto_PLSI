<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Venda;

/**
 * VendaSearch represents the model behind the search form of `common\models\Venda`.
 */
class VendaSearch extends Venda
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idUser_seller', 'idUser_buyer', 'idVehicle'], 'integer'],
            [['price'], 'number'],
            [['comment', 'number', 'nif', 'address', 'name'], 'safe'],
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
    public function search($params)
    {
        if (User::isEmployee(\Yii::$app->user->id)) {
            $query = Venda::find()->where(['idUser_seller' => \Yii::$app->user->id]);
        } else {
            $query = Venda::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5]

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
            'idUser_seller' => $this->idUser_seller,
            'idUser_buyer' => $this->idUser_buyer,
            'idVehicle' => $this->idVehicle,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'nif', $this->nif])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
