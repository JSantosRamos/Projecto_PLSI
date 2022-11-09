<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property string $serie
 * @property string $type
 * @property string $fuel
 * @property string $mileage
 * @property int $engine
 * @property string $color
 * @property string $description
 * @property int $year
 * @property int $doorNumber
 * @property string $transmission
 * @property float $price
 * @property string $image
 * @property int $isActive
 */
class Vehicle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand', 'model', 'serie', 'type', 'fuel', 'mileage', 'engine', 'color', 'description', 'year', 'doorNumber', 'transmission', 'price', 'image', 'isActive'], 'required'],
            [['engine', 'year', 'doorNumber', 'isActive'], 'integer'],
            [['price'], 'number'],
            [['image'], 'string'],
            [['brand', 'model', 'serie', 'type', 'fuel', 'mileage'], 'string', 'max' => 50],
            [['color', 'transmission'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'serie' => 'Serie',
            'type' => 'Type',
            'fuel' => 'Fuel',
            'mileage' => 'Mileage',
            'engine' => 'Engine',
            'color' => 'Color',
            'description' => 'Description',
            'year' => 'Year',
            'doorNumber' => 'Door Number',
            'transmission' => 'Transmission',
            'price' => 'Price',
            'image' => 'Image',
            'isActive' => 'Is Active',
        ];
    }
}
