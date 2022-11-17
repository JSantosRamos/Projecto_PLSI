<?php

namespace common\models;

class Permission
{
    /**
     * @param $id
     * @return boolean
     */
    public static function allowedAction($id): bool
    {
        return $id == \Yii::$app->user->id;
    }
}