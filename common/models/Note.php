<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property int $id
 * @property string $description
 * @property int $idUser
 * @property int $idTask
 * @property string $create_at
 *
 * @property Task $idTask0
 * @property User $idUser0
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
            [['description', 'idUser', 'idTask'], 'required'],
            [['idUser', 'idTask'], 'integer'],
            [['create_at'], 'safe'],
            [['description'], 'string', 'max' => 50],
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
            'description' => 'Description',
            'idUser' => 'Id User',
            'idTask' => 'Id Task',
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
}
