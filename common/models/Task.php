<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $type
 * @property string $date
 * @property string $description
 * @property string $status
 * @property int $idCreated_by
 * @property string $created_at
 * @property int $idAssigned_to
 *
 * @property User $idAssignedTo
 * @property User $idCreatedBy
 */
class Task extends \yii\db\ActiveRecord
{
    const Por_INICIAR = 'Por iniciar';
    const EM_PROCESSO = 'Em_Processo';
    const FINALIZADA = 'Finalizado';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'date', 'description', 'status', 'idCreated_by', 'idAssigned_to'], 'required'],
            [['date', 'created_at'], 'safe'],
            [['status'], 'string'],
            [['idCreated_by', 'idAssigned_to'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 300],
            [['idAssigned_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idAssigned_to' => 'id']],
            [['idCreated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['idCreated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Nº da Tarefa',
            'type' => 'Tipo',
            'date' => 'Data',
            'description' => 'Description',
            'status' => 'Estado',
            'idCreated_by' => 'Criado por',
            'created_at' => 'Criada em',
            'idAssigned_to' => 'Funcionário',
        ];
    }

    /**
     * Gets query for [[IdAssignedTo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAssignedTo()
    {
        return $this->hasOne(User::class, ['id' => 'idAssigned_to']);
    }

    /**
     * Gets query for [[IdCreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'idCreated_by']);
    }
}
