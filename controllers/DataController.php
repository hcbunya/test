<?php

namespace app\controllers;
use app\components\DataAdapter;

class DataController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataAdapter = new DataAdapter();
        $dataAdapter->getData(2016);
//        $dataAdapter->dumpData();
        $dataAdapter->dataProcess();

        return $this->render('index',['status' => $dataAdapter->getStatus()]);
    }

}
