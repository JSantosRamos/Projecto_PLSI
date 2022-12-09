<?php

namespace common\models;

use PHPUnit\Util\Test;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Testdrive;

/**
 * TestdriveSearch represents the model behind the search form of `common\models\Testdrive`.
 */
class TestdriveSearch extends Testdrive
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idUser', 'idVehicle'], 'integer'],
            [['date', 'time', 'description', 'status', 'reason'], 'safe'],
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
            $query = Testdrive::find();
        }else{
            $query = Testdrive::find()->where(['iduser' => \Yii::$app->user->id]);
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
            'date' => $this->date,
            'idUser' => $this->idUser,
            'idVehicle' => $this->idVehicle,
        ]);

        $query->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
