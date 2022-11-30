<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendauser".
 *
 * @property int $id
 * @property int $idUser
 * @property float $price
 * @property string $date
 * @property string $plate
 * @property int $mileage
 * @property string $fuel
 * @property string $year
 * @property string $brand
 * @property string $model
 * @property string|null $serie
 * @property string|null $description
 * @property string $status
 *
 * @property User $idUser0
 */
class Vendauser extends \yii\db\ActiveRecord
{
    const POR_VER = 'Por ver';
    const ACEITE = 'Aceite';
    const RECUSADO = 'Recusado';
    const EM_ANALISE = 'Em Análise';
    const AGUARDANDO_RESPOSTA = 'Aguardando Resposta';

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
            [['idUser', 'mileage'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['fuel', 'status'], 'string'],
            [['plate'], 'string', 'max' => 8],
            [['year'], 'string', 'max' => 10],
            [['brand', 'model'], 'string', 'max' => 20],
            [['serie'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 500],
            ['status', 'default', 'value' => self::POR_VER],
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
            'idUser' => 'Utilizador',
            'price' => 'Valor pretendido',
            'date' => 'Data',
            'plate' => 'Matricula',
            'mileage' => 'Quilómetro',
            'fuel' => 'Combústivel',
            'year' => 'Ano',
            'brand' => 'Marca',
            'model' => 'Modelo',
            'serie' => 'Serie',
            'description' => 'Extras',
            'status' => 'Estado',
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
