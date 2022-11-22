<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cost".
 *
 * @property int $id
 * @property int $idUser
 * @property string $title
 * @property float $valor
 * @property string $file
 */
class Cost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUser', 'title', 'valor', 'file'], 'required'],
            [['idUser'], 'integer'],
            [['valor'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['file'], 'string', 'max' => 2000],
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
            'valor' => 'Valor',
            'file' => 'File',
        ];
    }
}
