<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "reserve".
 *
 * @property int $id
 * @property int $idUser
 * @property int $idVehicle
 * @property string $number
 * @property string $nif
 * @property string $morada
 * @property string $cc
 * @property string $create_at
 */
class Reserve extends \yii\db\ActiveRecord
{

    public $ccFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'idVehicle', 'number', 'nif', 'morada', 'cc', 'ccFile'], 'required'],
            [['idUser', 'idVehicle'], 'integer'],
            [['ccFile'], 'file'],
            [['cc'], 'string'],
            [['create_at'], 'safe'],
            [['number', 'nif'], 'string', 'max' => 11],
            [['number', 'nif'], 'string', 'min' => 9],
            [['morada'], 'string', 'max' => 30],
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
            'idVehicle' => 'Referência do Veículo',
            'number' => 'Número',
            'nif' => 'NIF',
            'morada' => 'Morada',
            'cc' => 'Cartão de cidadão:',
            'create_at' => 'Data',
            'ccFile' => 'Cartão de cidadão:'
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->ccFile) {

            $this->cc = '/reserve/' . Yii::$app->security->generateRandomString() . '/' . $this->ccFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $result = parent::save($runValidation, $attributeNames);

        if ($result && $this->ccFile) {
            $path = Yii::getAlias('@backend/web/storage' . $this->cc);
            $dir = dirname($path);
            if (!FileHelper::createDirectory($dir) | !$this->ccFile->saveAs($path)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $result;
    }

    public function fileName($file){
        return substr(strrchr($file,'/'), 1);
    }
}
