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
 * @property string $title
 * @property string $plate
 */
class Vehicle extends \yii\db\ActiveRecord
{
    public $imageFile;

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
            [['brand', 'model', 'serie', 'type', 'fuel', 'mileage', 'engine', 'color', 'description', 'year', 'doorNumber', 'transmission', 'price', 'image', 'isActive', 'title', 'plate'], 'required'],
            [['type', 'fuel', 'color', 'description', 'transmission', 'image'], 'string'],
            [['engine', 'year', 'doorNumber', 'isActive'], 'integer'],
            [['price'], 'number'],
            [['brand', 'model', 'serie', 'mileage', 'title'], 'string', 'max' => 50],
            [['plate'], 'string', 'max' => 8],
            [['plate'], 'unique'],
            [['imageFile'], ['image'], ]
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
            'title' => 'Title',
            'plate' => 'Plate',
            'imageFile' => 'Inserir Imagem',
        ];
    }
}
