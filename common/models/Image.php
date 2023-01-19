<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $path
 * @property int $idVehicle
 *
 * @property Vehicle $idVehicle0
 */
class Image extends \yii\db\ActiveRecord
{
    public $imageFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imageFile', 'idVehicle'], 'required'],
            [['path'], 'string'],
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],
            [['idVehicle'], 'integer'],
            [['idVehicle'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicle::class, 'targetAttribute' => ['idVehicle' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Imagem',
            'imageFile' => 'Escolher Imagem',
            'idVehicle' => 'Veículo',
        ];
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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {

            $this->path = '/vehicles/' . Yii::$app->security->generateRandomString() . '/' . $this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $result = parent::save($runValidation, $attributeNames);

        if ($result && $this->imageFile) {
            $pathImage = Yii::getAlias('@backend/web/storage' . $this->path);
            $dir = dirname($pathImage);
            if (!FileHelper::createDirectory($dir) | !$this->imageFile->saveAs($pathImage)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $result;
    }

    public function getImageUrl()
    {
        return Yii::$app->params['backendUrl'] . '/storage' . $this->path;
    }
}
