<?php

use yii\db\Migration;

class m160508_115254_add_data_table extends Migration
{
    public function up()
    {
        $this->createTable('games', [
            'id' => $this->primaryKey(),
            'api_game_id' => $this->integer(11)->notNull()->unique(),
            'game_date' => $this->dateTime('Y-m-d H:i:s'),
        ]);
    }

    public function down()
    {
        $this->dropTable('games');
    }

}
