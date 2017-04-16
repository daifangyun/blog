<?php

use yii\db\Migration;

class m170412_025933_category extends Migration
{
    private $tableName = '{{%category}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('自增id'),

            'name' => $this->string(50)->notNull()->defaultValue('')->comment('分类名称'),
            'pid' => $this->integer(11)->defaultValue(0)->comment('0:顶级分类 || > 0 对应id列的值'),

            'sort' => $this->integer(4)->defaultValue(0)->comment('排序,按照由大到小的顺序排,大的在前边,小的在后边'),
            'status' => $this->smallInteger(1)->defaultValue(0)->comment('是否有效,1:有效,0:无效,-1:永久删除'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('最后修改时间'),
        ], $tableOptions);

        //插入一条数据
        $this->insert($this->tableName, [
            'name' => '	Mysql',
            'pid' => 0,
            'sort' => 1,
            'status' => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
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
