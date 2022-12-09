<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "venda".
 *
 * @property int $id
 * @property int $idUser_seller
 * @property int $idUser_buyer
 * @property int $idVehicle
 * @property float $Price
 * @property string|null $comment
 *
 * @property User $idUserBuyer
 * @property User $idUserSeller
 */
class Venda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser_buyer', 'idVehicle', 'Price'], 'required'],
            [['idUser_seller', 'idUser_buyer', 'idVehicle'], 'integer'],
            [['Price'], 'number'],
            [['comment'], 'string', 'max' => 100],
            [['idUser_buyer'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idUser_buyer' => 'id']],
            [['idUser_seller'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idUser_seller' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'NºVenda',
            'idUser_seller' => 'Vendedor',
            'idUser_buyer' => 'Comprador',
            'idVehicle' => 'Referência do Veículo',
            'Price' => 'Preço',
            'comment' => 'Outro',
        ];
    }

    /**
     * Gets query for [[IdUserBuyer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserBuyer()
    {
        return $this->hasOne(User::class, ['id' => 'idUser_buyer']);
    }

    /**
     * Gets query for [[IdUserSeller]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserSeller()
    {
        return $this->hasOne(User::class, ['id' => 'idUser_seller']);
    }

    /**
     * Gets query for [[IdUserSeller]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdVehicle()
    {
        return $this->hasOne(Vehicle::class, ['id' => 'idVehicle']);
    }

    public static function getValorVendas(){
        $totalVendas = 0;
        $vendas = Venda::find()->select('Price')->all();

        foreach ($vendas as $venda) {
            $totalVendas = $venda->Price + $totalVendas;
        }

        return $totalVendas;
    }
}
