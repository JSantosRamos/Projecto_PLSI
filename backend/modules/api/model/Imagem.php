<?php

namespace backend\modules\api\model;

class Imagem
{
    public $id;
    public $url;
    public $idVehicle;

    function __construct($id, $url,$idVehicle)
    {
        $this->id = $id;
        $this->url = $url;
        $this->idVehicle = $idVehicle;
    }
}
