<?php

namespace common\models;

class Permission
{
    /**
     * Check if id in param is equals to login id
     * @param $id
     * @return boolean
     */
    public static function allowedAction($id): bool
    {
        return $id == \Yii::$app->user->id;
    }
}