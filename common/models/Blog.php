<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property int $idUser
 * @property string $title
 * @property string $description
 * @property string $data
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'title', 'description'], 'required'],
            [['idUser'], 'integer'],
            [['description'], 'string'],
            [['data'], 'safe'],
            [['title'], 'string', 'max' => 50],
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
            'title' => 'Title',
            'description' => 'Description',
            'data' => 'Data',
        ];
    }
}
