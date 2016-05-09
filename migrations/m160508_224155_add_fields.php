<?php

use yii\db\Migration;

class m160508_224155_add_fields extends Migration
{
    public function up()
    {
        $this->addColumn('games','team_home','VARCHAR(255) NOT NULL');
        $this->addColumn('games','away_team','VARCHAR(255) NOT NULL');
        $this->addColumn('games','stadium_id','INT(11) NOT NULL');

        $this->createIndex('games_stadium_id','games','stadium_id');
    }

    public function down()
    {
        $this->dropColumn('games','team_home');
        $this->dropColumn('games','away_team');
        $this->dropColumn('games','stadium_id');
    }

}
