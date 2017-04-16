<?php

use yii\db\Migration;

class m170307_031511_article extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey()->comment('自增id'),
            'cid' => $this->integer(11)->notNull()->defaultValue(0)->comment('所属分类，对应category迁移的id'),
            'title' => $this->string(255)->notNull()->comment('文章标题'),
            'abstract' => $this->string(255)->notNull()->comment('文章摘要'),
            'look' => $this->integer(11)->notNull()->defaultValue(0)->comment('查看次数'),
            'content' => $this->text()->comment('文章详情'),
            'status' => $this->smallInteger(1)->defaultValue(1)->comment('是否有效,1:有效,0:无效'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('最后修改时间'),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%article}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
