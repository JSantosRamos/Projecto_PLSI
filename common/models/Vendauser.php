<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendauser".
 *
 * @property int $id
 * @property int $idUser
 * @property float $price
 * @property string $reason
 * @property string $date
 * @property string $plate
 * @property int $mileage
 * @property string $fuel
 * @property int $year
 * @property string $brand
 * @property string $model
 * @property string|null $serie
 * @property int|null $description
 * @property string $status
 *
 * @property User $idUser0
 */
class Vendauser extends \yii\db\ActiveRecord
{
    const POR_VER = 'Por ver';
    const ACEITE = 'Aceite';
    const EM_ANALISE = 'Em Análise';
    const RECUSADO = 'Recusado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendauser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'price', 'plate', 'mileage', 'fuel', 'year', 'brand', 'model'], 'required'],
            [['idUser', 'mileage', 'year'], 'integer'],
            [['price'], 'number'],
            ['status', 'default', 'value' => self::POR_VER],
            [['date'], 'safe'],
            [['fuel', 'status', 'model', 'serie', 'description'], 'string'],
            [['reason'], 'string', 'max' => 50],
            [['plate'], 'string', 'max' => 8],
            [['brand'], 'string', 'max' => 10],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idUser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Id User',
            'price' => 'Valor pretendido',
            'date' => 'Date',
            'plate' => 'Matrícula',
            'mileage' => 'Quilômetros ',
            'fuel' => 'Combústivel',
            'year' => 'Ano',
            'brand' => 'Marca',
            'model' => 'Modelo',
            'serie' => 'Serie',
            'description' => 'Extras',
            'status' => 'Estado da proposta',
        ];
    }

    /**
     * Gets query for [[IdUser0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser0()
    {
        return $this->hasOne(User::class, ['id' => 'idUser']);
    }
}
