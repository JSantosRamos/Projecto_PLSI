<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property string $description
 * @property int $idUser
 * @property int|null $idTask
 * @property int|null $idproposta_venda
 * @property string $create_at
 *
 * @property Task $idTask0
 * @property User $idUser0
 * @property Vendauser $idpropostaVenda
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'idUser'], 'required'],
            [['idUser', 'idTask', 'idproposta_venda'], 'integer'],
            [['description'], 'string', 'max' => 50],
            [['idproposta_venda'], 'exist', 'skipOnError' => true, 'targetClass' => Vendauser::class, 'targetAttribute' => ['idproposta_venda' => 'id']],
            [['idTask'], 'exist', 'skipOnError' => true, 'targetClass' => Task::class, 'targetAttribute' => ['idTask' => 'id']],
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
            'description' => 'Descrição',
            'idUser' => 'Id User',
            'idTask' => 'Id Task',
            'idproposta_venda' => 'Idproposta Venda',
            'create_at' => 'Create At',
        ];
    }

    /**
     * Gets query for [[IdTask0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTask0()
    {
        return $this->hasOne(Task::class, ['id' => 'idTask']);
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
     * Gets query for [[IdpropostaVenda]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpropostaVenda()
    {
        return $this->hasOne(Vendauser::class, ['id' => 'idproposta_venda']);
    }
}
