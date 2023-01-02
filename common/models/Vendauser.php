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
            [['idUser'], 'integer'],
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

    public static function getTotal()
    {
        return Vendauser::find()->count();
    }

    public static function getTotalStatus()
    {

        $porVer = 0;
        $emAnalise = 0;
        $aceite = 0;
        $resposta = 0;
        $recusado = 0;

        $vendas = Vendauser::find()->all();

        foreach ($vendas as $venda) {

            switch ($venda->status) {
                case Vendauser::POR_VER:
                    ++$porVer;
                    break;

                case Vendauser::EM_ANALISE:
                    ++$emAnalise;
                    break;
                case Vendauser::ACEITE:
                    ++$aceite;
                    break;
                case Vendauser::AGUARDANDO_RESPOSTA:
                    ++$resposta;
                    break;

                case Vendauser::RECUSADO:
                    ++$recusado;
                    break;
            }
        }

        return array("porVer" => $porVer, "emAnalise" => $emAnalise,
            "aceite" => $aceite, "resposta" => $resposta, "recusado" => $recusado);
    }

    public static function getValorTotal()
    {
        $vendas = Vendauser::find()->select("price")->where(["status" => Vendauser::ACEITE])->all();
        $total = 0;

        foreach ($vendas as $venda) {
            $total = $total + $venda->price;
        }

        return $total;
    }

    /*public function beforeSave($insert)
    {
        $name_brand = Brand::find()->select("name")->where(['id' => $this->brand]);
        $name_model = Model::find()->select("name")->where(['id' => $this->model]);

        $name_brand = empty($name_brand) ? "Sem marca(erro model)" : $name_brand;
        $name_model = empty($name_model) ? "Sem modelo(erro model)" : $name_model;

        $this->brand = $name_brand;
        $this->model = $name_model;

        return parent::beforeSave($insert);
    }*/
}
