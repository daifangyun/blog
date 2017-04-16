<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    private $tableName = '{{%user}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'username' => $this->string(32)->notNull()->unique()->defaultValue('')->comment('账号'),
            'auth_key' => $this->string(32)->defaultValue('')->comment('自动登录key'),
            'password_hash' => $this->string()->notNull()->defaultValue('')->comment('加密密码'),
            'password_reset_token' => $this->string()->unique()->defaultValue('')->comment('重置密码token'),
            'nickname' => $this->string(30)->notNull()->defaultValue('')->comment('昵称'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('账号状态,10:启用:0:不启用,-1:永久删除'),
            'created_at' => $this->integer()->notNull()->defaultValue(0)->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)->comment('最后修改时间'),
        ], $tableOptions);

        //插入一条数据
        $this->insert($this->tableName, [
            'id' => 1,
            'username' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'nickname' => '超级管理员',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
