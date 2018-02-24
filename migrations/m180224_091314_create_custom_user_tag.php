<?php

use yii\db\Migration;

class m180224_091314_create_custom_user_tag extends Migration
{
    public function safeUp()
    {

        $this->createTable('custom_user_tag', array(
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ), '');

        $this->createIndex("index_custom_user_tag_title", "custom_user_tag", "title");


        foreach (\humhub\modules\user\models\User::find()->all() as $user) {
            \humhub\modules\custom_user_tag\models\CustomUserTag::handleUpdateUserTags($user);
        }
    }

    public function safeDown()
    {

        $this->dropIndex("index_custom_user_tag_title", "custom_user_tag");
        $this->dropTable("custom_user_tag");

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180224_091314_create_custom_user_tag cannot be reverted.\n";

        return false;
    }
    */
}
