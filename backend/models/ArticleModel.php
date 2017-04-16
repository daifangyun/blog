<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 13:57
 */

namespace backend\models;


use common\models\Article;

class ArticleModel extends Article
{
    /**
     * 获取关联分类的字段
     * @var
     */
    public static $getCategoryField;

    /**
     * 设置获取关联分类的字段
     * @param $set
     */
    public static function setGetCategoryField($set)
    {
        self::$getCategoryField = $set;
    }

    /**
     * 关联获取分类属性
     * @return $this
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryModel::className(), ['id' => 'cid'])->select(self::$getCategoryField);
    }
}