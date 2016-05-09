<?php

namespace app\controllers;

use yii\helpers\Json;

class IndexController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index',[
            'data' => Json::decode(file_get_contents(\Yii::$app->urlManager->getHostInfo() . '/games?per-page=50000'),true)
        ]);
    }

}
