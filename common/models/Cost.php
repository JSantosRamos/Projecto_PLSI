<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

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
    public $uploadFile;

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
            [['idUser', 'title', 'valor'], 'required'],
            [['idUser'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idUser' => 'Adicionado por',
            'title' => 'Texto',
            'valor' => 'Valor',
            'file' => 'Ficheiro',
            'uploadFile' => 'Selecionar...'
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->uploadFile) {
            $this->file = '/costs/' . Yii::$app->security->generateRandomString() . '/' . $this->uploadFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $result = parent::save($runValidation, $attributeNames);

        if ($result && $this->uploadFile) {
            $path = Yii::getAlias('@backend/web/storage' . $this->file);
            $dir = dirname($path);
            if (!FileHelper::createDirectory($dir) | !$this->uploadFile->saveAs($path)) {
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

    public static function getValorDespesas(){

        $totalDespesas = 0;

        $despesas = Cost::find()->select('valor')->all();
        foreach ($despesas as $despesa) {
            $totalDespesas = $despesa->valor + $totalDespesas;
        }

        return $totalDespesas;
    }
}
