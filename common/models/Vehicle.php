<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "vehicle".
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property string|null $serie
 * @property string $type
 * @property string $fuel
 * @property string $mileage
 * @property int $engine
 * @property string $color
 * @property string $description
 * @property int $year
 * @property int $doorNumber
 * @property string $transmission
 * @property float $price
 * @property string|null $image
 * @property int $isActive
 * @property string $title
 * @property string $plate
 * @property string $status
 * @property int $cv
 * @property int $idBrand
 * @property int $idModel
 */
class Vehicle extends \yii\db\ActiveRecord
{
    public $imageFile;

    const STATUS_SOLD = 'Vendido';
    const STATUS_RESERVED = 'Reservado';
    const STATUS_AVAILABLE = 'Disponível';

    const ACTIVE = 1;
    const INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'fuel', 'mileage', 'engine', 'color', 'description', 'year', 'doorNumber', 'transmission', 'price', 'isActive', 'title', 'plate', 'status', 'idBrand', 'idModel', 'cv'], 'required'],
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],
            [['type', 'fuel', 'color', 'description', 'transmission'], 'string'],
            [['engine', 'year', 'doorNumber', 'isActive', 'idModel', 'cv'], 'integer'],
            [['brand', 'model', 'serie', 'mileage', 'title'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 2000],
            [['plate'], 'string', 'max' => 8],
            [['plate'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Marca',
            'model' => 'Modelo',
            'serie' => 'Serie',
            'type' => 'Tipologia',
            'fuel' => 'Combustível',
            'mileage' => 'Quilómetros',
            'engine' => 'Cilindrada',
            'color' => 'Color',
            'description' => 'Descrição',
            'year' => 'Ano',
            'doorNumber' => 'Nº de Portas',
            'transmission' => 'Tipo de Caixa',
            'price' => 'Preço',
            'image' => 'Image',
            'isActive' => 'Publicar',
            'title' => 'Titulo',
            'plate' => 'Matrícula',
            'imageFile' => 'Escolher Imagem',
            'status' => 'Estado',
            'idModel' => 'Modelo',
            'idBrand' => 'Marca',
            'cv' => 'CV',
        ];
    }

    /**
     * Gets query for [[Vendausers]].
     *
     * @return ActiveQuery
     */
    public function getVendausers()
    {
        return $this->hasMany(Vendauser::class, ['idVehicle' => 'id']);
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {

            $this->image = '/vehicles/' . Yii::$app->security->generateRandomString() . '/' . $this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $result = parent::save($runValidation, $attributeNames);

        if ($result && $this->imageFile) {
            $path = Yii::getAlias('@frontend/web/storage' . $this->image);
            $dir = dirname($path);
            if (!FileHelper::createDirectory($dir) | !$this->imageFile->saveAs($path)) {
                $transaction->rollBack();

                return false;
            }
        }

        $transaction->commit();

        return $result;
    }

    public function getImageUrl()
    {
        return Yii::$app->params['frontendUrl'] . '/storage' . $this->image;
    }

    public function getModelName()
    {
        $model = Model::findOne(['id' => $this->idModel]);

        return $model == null ? '' : $model->name;
    }

    public function getBrandName()
    {
        $brand = Brand::findOne(['id' => $this->idBrand]);

        return $brand == null ? '' : $brand->name;
    }

    public static function getTotal()
    {
        return Vehicle::find()->count();
    }

    public static function getTotalStatus()
    {
        $vendido = 0;
        $reservado = 0;
        $disponivel = 0;

        $items = Vehicle::find()->all();
        foreach ($items as $item) {

            switch ($item->status) {
                case 'Vendido':
                    ++$vendido;
                    break;

                case 'Reservado':
                    ++$reservado;
                    break;

                case 'Disponível':
                    ++$disponivel;
                    break;
            }
        }

        return array("vendido" => $vendido, "reservado" => $reservado, "disponivel" => $disponivel);
    }

    public static function getPlate($id)
    {
        $vehicle = Vehicle::find()->where(['id' => $id])->one();
        return $vehicle->plate;
    }

    public static function getBrandNameByVehicleId($id)
    {
        $vehicle = Vehicle::findOne($id);
        $brand = null;

        if ($vehicle != null) {
            $brand = Brand::findOne($vehicle->idBrand);
        }
        return $brand == null ? '' : $brand->name;
    }
}
