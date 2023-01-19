<?php

namespace backend\modules\api\model;

class Vendedor
{
    public $email;
    public $name;

    function __construct($email, $name)
    {
        $this->name = $name;
        $this->email = $email;
    }

}