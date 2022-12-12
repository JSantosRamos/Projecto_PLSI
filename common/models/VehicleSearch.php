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
    public int $priceMin = 0;
    public int $priceMax = 1000000;

    public int $mileageMin = 0;
    public int $mileageMax = 1000000;

    //ublic $price_order_by;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'engine', 'year', 'doorNumber', 'isActive', 'idBrand', 'idModel'], 'integer'],
            [['serie', 'type', 'fuel', 'mileage', 'color', 'description', 'transmission', 'image', 'title', 'plate', 'status', 'idBrand', 'idModel'], 'safe'],
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
        if ($frontendview) {
            $query = Vehicle::find()->where(['isActive' => 1]);
        } else {
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

        //check price min and max values
        $this->checkPriceMinAndMaxValuesPrice();

        //check mileage filter values
        $this->checkPriceMinAndMaxValuesMileage();

        //check order price
        // if ($this->price_order_by)

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'engine' => $this->engine,
            'year' => $this->year,
            'doorNumber' => $this->doorNumber,
            'isActive' => $this->isActive,
            'idBrand' => $this->idBrand,
            'idModel' => $this->idModel,
        ])
            ->andFilterWhere(['between', 'price', $this->priceMin, $this->priceMax])
            ->andFilterWhere(['between', 'mileage', $this->mileageMin, $this->mileageMax]);

        $query->andFilterWhere(['like', 'serie', $this->serie])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'fuel', $this->fuel])
            // ->andFilterWhere(['like', 'mileage', $this->mileage])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'transmission', $this->transmission])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'plate', $this->plate]);

        return $dataProvider;
    }

    /**
     * @return void
     */
    public function checkPriceMinAndMaxValuesPrice(): void
    {
        if ($this->price == 1) {
            $this->priceMin = 0;
            $this->priceMax = 15000;
        } elseif ($this->price == 2) {
            $this->priceMin = 15000;
            $this->priceMax = 30000;
        } elseif ($this->price == 3) {
            $this->priceMin = 30000;
            $this->priceMax = 45000;
        } elseif ($this->price == 4) {
            $this->priceMin = 45000;
            $this->priceMax = 60000;
        } elseif ($this->price == 5) {
            $this->priceMin = 60000;
            $this->priceMax = 75000;
        } elseif ($this->price == 6) {
            $this->priceMin = 75000;
            $this->priceMax = 90000;
        } elseif ($this->price == 7) {
            $this->priceMin = 90000;
            $this->mileageMax = 1000000;
        }
    }

    /**
     * @return void
     */
    public function checkPriceMinAndMaxValuesMileage(): void
    {
        if ($this->mileage == 1) {
            $this->mileageMin = 0;
            $this->mileageMax = 25000;
        } elseif ($this->mileage == 2) {
            $this->mileageMin = 25000;
            $this->mileageMax = 50000;
        } elseif ($this->mileage == 3) {
            $this->mileageMin = 50000;
            $this->mileageMax = 75000;
        } elseif ($this->mileage == 4) {
            $this->mileageMin = 75000;
            $this->mileageMax = 100000;
        } elseif ($this->mileage == 5) {
            $this->mileageMin = 100000;
            $this->mileageMax = 125000;
        } elseif ($this->mileage == 6) {
            $this->mileageMin = 125000;
            $this->mileageMax = 150000;
        } elseif ($this->mileage == 7) {
            $this->mileageMin = 150000;
            $this->mileageMax = 1000000;
        }
    }
}
