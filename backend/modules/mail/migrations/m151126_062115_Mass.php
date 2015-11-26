<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_062115_Mass extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';
		$connection=Yii::$app->db;
		$transaction=$connection->beginTransaction();
		try{
            $this->createTable('{{%mail_detail}}',
        	[
                'id'=> Schema::TYPE_PK.'',
                'user_id'=> Schema::TYPE_INTEGER.'(11) NOT NULL',
                'type'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'incomming'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'imapPath'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'serverEncoding'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'attachmentsDir'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'imapLogin'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'imapPassword'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'folder'=> Schema::TYPE_STRING.'(150) NOT NULL',
                'active'=> Schema::TYPE_BOOLEAN.'(1) NOT NULL DEFAULT "0"',
            ], $tableOptions);
            
            $transaction->commit();
		} catch (Exception $e) {
			echo 'Catch Exception '.$e->getMessage().' and rollBack this';
    		$transaction->rollBack();
		}
    }

    public function safeDown()
    {
		$connection=Yii::$app->db;
		$transaction=$connection->beginTransaction();
		try{                                                    
		    $this->dropTable('{{%mail_detail}}');
			$transaction->commit();
		} catch (Exception $e) {
			echo 'Catch Exception '.$e->getMessage().' and rollBack this';
			$transaction->rollBack();
		}
    }
}
