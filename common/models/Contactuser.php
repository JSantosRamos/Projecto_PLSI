<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contactuser".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 */
class Contactuser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactuser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'email', 'subject'], 'string', 'max' => 50],
            [['body'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'email' => 'Email',
            'subject' => 'Assunto',
            'body' => 'Descrição',
        ];
    }
}
