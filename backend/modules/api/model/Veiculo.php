<?php

namespace backend\modules\api\model;

class Veiculo
{
    public $id;
    public $brand;
    public $model;
    public $serie;
    public $type;
    public $fuel;
    public $mileage;
    public $engine;
    public $color;
    public $description;
    public $year;
    public $doorNumber;
    public $transmission;
    public $price;
    public $image;
    public $title;
    public $plate;
    public $cv;
    public $listImages;

    function __construct($id, $brand, $model, $serie, $type, $fuel, $mileage, $engine, $color, $description, $year, $doorNumber, $transmission, $price, $image, $title, $plate, $cv, $listImages)
    {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->serie = $serie;
        $this->type = $type;
        $this->fuel = $fuel;
        $this->mileage = $mileage;
        $this->engine = $engine;
        $this->color = $color;
        $this->description = $description;
        $this->year = $year;
        $this->doorNumber = $doorNumber;
        $this->transmission = $transmission;
        $this->price = $price;
        $this->image = $image;
        $this->title = $title;
        $this->plate = $plate;
        $this->cv = $cv;
        $this->listImages = $listImages;
    }

}