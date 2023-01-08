<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "model".
 *
 * @property int $id
 * @property string $name
 * @property int $idBrand
 *
 * @property Brand $idBrand0
 * @property Vehicle[] $vehicles
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'idBrand'], 'required'],
            [['idBrand'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['idBrand'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::class, 'targetAttribute' => ['idBrand' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'idBrand' => 'Id Brand',
        ];
    }

    /**
     * Gets query for [[IdBrand0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdBrand0()
    {
        return $this->hasOne(Brand::class, ['id' => 'idBrand']);
    }

    /**
     * Gets query for [[Vehicles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::class, ['idModel' => 'id']);
    }

    public static function getModels($id)
    {
        $models = Model::find()->where(["idBrand" => $id])->all();

        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function getNameById($id)
    {
        $model = Model::findOne(['id' => $id]);
        return $model == null ? '' : $model->name;
    }
}
