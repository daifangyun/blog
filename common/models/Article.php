<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $title
 * @property string $abstract
 * @property integer $look
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Article extends \yii\db\ActiveRecord
{
    const ENABLE_STATUS = 1;
    const DISABLE_STATUS = 0;
    const DELETE_STATUS = -1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'title' => '文章标题',
            'abstract' => '文章摘要',
            'look' => '查看次数',
            'content' => '文章详情',
            'status' => '是否有效,1:有效,0:无效',
            'created_at' => '创建时间',
            'updated_at' => '最后修改时间',
        ];
    }
}
