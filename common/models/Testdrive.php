<?php

namespace common\models;

use backend\mosquitto\phpMQTT;
use Codeception\PHPUnit\Wrapper\Test;
use Yii;

/**
 * This is the model class for table "testdrive".
 *
 * @property int $id
 * @property string $date
 * @property string $time
 * @property string $description
 * @property int $idUser
 * @property int $idVehicle
 * @property string $status
 * @property User $idUser0
 * @property Vehicle $idVehicle0
 */
class Testdrive extends \yii\db\ActiveRecord
{
    const POR_VER = 'Por ver';
    const ACEITE = 'Aceite';
    const RECUSADO = 'Recusado';
    const EM_ANALISE = 'Em análise';
    const AGUARDANDO_RESPOSTA = 'Aguardando Resposta';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'testdrive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'time', 'description', 'idUser', 'idVehicle'], 'required'],
            [['time', 'status', 'date'], 'string'],
            ['status', 'default', 'value' => self::POR_VER],
            [['idUser', 'idVehicle'], 'integer'],
            [['description'], 'string', 'max' => 100],
            [['idUser'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idUser' => 'id']],
            [['idVehicle'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::class, 'targetAttribute' => ['idVehicle' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Nº',
            'date' => 'Dia',
            'time' => 'Hora',
            'description' => 'Diga-nos porque escolheu este veículo:',
            'idUser' => 'Utilizador',
            'idVehicle' => 'Refêrencia do Veículo',
            'status' => 'Estado do Pedido',
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

    /**
     * Gets query for [[IdVehicle0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdVehicle0()
    {
        return $this->hasOne(Vehicle::class, ['id' => 'idVehicle']);
    }

    public static function getTotal()
    {
        return Testdrive::find()->count();
    }


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        $msg = '';
        $canal = 'Testdrives';

        if ($insert) {
            $msg = 'Novo Testdrive do veiculo ' .$this->idVehicle . ' por ' . User::getNameById($this->idUser);

        } else {
            $msg = 'Testdrive do veiculo: ' .$this->idVehicle . ' do Utilizador: ' . User::getNameById($this->idUser) . ' foi alterado por '.
            User::getNameById(Yii::$app->user->id);
        }
        $this->doPublish($canal, $msg);
    }

    private function doPublish($canal, $msg)
    {
        $server = '127.0.0.1';
        $port = 1883;
        $username = "";
        $password = "";
        $clientId = "phpMQTT-publisher";
        $mqtt = new phpMQTT($server, $port, $clientId);

        if($mqtt->connect(true, NULL, $username, $password)){
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }else{
            file_put_contents("debug.output", "timeout");
        }
    }
}
