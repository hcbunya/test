<?php

namespace app\components;

use app\models\Games;
use yii\base\Component;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 08.05.16
 * Time: 23:42
 */

Class DataAdapter{

    private static $key = 'e75c1d56fa61493790786d38c911e31e';
    private $format;
    private $response;


    public function getStatus(){
        if ($this->response){
            return 'Данные успешно распарсены и сохраннеы в базе';
        }
        return 'Ошибка парсинга, смотрите логи';
    }

    public function __construct($format = 'xml')
    {
        $this->format = $format;
    }

    public function dumpData(){
        header("Content-Type: text/xml");
        header("Expires: Thu, 19 Feb 1998 13:24:18 GMT");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Cache-Control: post-check=0,pre-check=0");
        header("Cache-Control: max-age=0");
        header("Pragma: no-cache");

        echo $this->response;
    }

    public function dataProcess(){
        $games = new \SimpleXMLElement($this->response);
        $transaction = \Yii::$app->db->beginTransaction();
        foreach ($games as $game) {
            $gameId = (int)$game->GameID;
            $model = new Games([
                'api_game_id' => $gameId,
                'game_date' =>date('Y-m-d H:i:s',strtotime((string) $game->DateTime)),
                'team_home' => (string) $game->HomeTeam,
                'away_team' => (string) $game->AwayTeam,
                'stadium_id' => (string) $game->StadiumID,
            ]);
            $model->save();
        }
        $transaction->commit();
    }

    public function getData($year = 2016){
            $this->response = file_get_contents($this->prepareUrl($year), false, stream_context_create(array(
                'http' => array(
                    'method' => 'GET',
                    'header' => "Ocp-Apim-Subscription-Key: " . self::$key,
                )
            )));
    }

    private function prepareUrl($year){
        return "https://api.fantasydata.net/mlb/v2/{$this->format}/Games/{$year}";
    }
}