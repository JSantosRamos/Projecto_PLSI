<?php

namespace common\models;

use common\models\Reserve;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ReserveSearch represents the model behind the search form of `common\models\Reserve`.
 */
class ReserveSearch extends Reserve
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idUser', 'idVehicle'], 'integer'],
            [['number', 'nif', 'morada', 'cc', 'create_at'], 'safe'],
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
            $query = Reserve::find()->orderBy(["id" => SORT_DESC]);
        }else{
            $query = Reserve::find()->where(['iduser' => \Yii::$app->user->id])->orderBy(["id" => SORT_DESC]);
        }

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
            'idUser' => $this->idUser,
            'idVehicle' => $this->idVehicle,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'nif', $this->nif])
            ->andFilterWhere(['like', 'morada', $this->morada])
            ->andFilterWhere(['like', 'cc', $this->cc]);

        return $dataProvider;
    }
}
