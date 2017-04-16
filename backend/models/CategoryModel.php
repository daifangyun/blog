<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 12:54
 */

namespace backend\models;

use common\models\Category;

class CategoryModel extends Category
{
    /**
     * 根据id来删除
     * @param $id int
     * @return bool
     */
    public static function delById($id)
    {
        $id = (int)$id;
        if (!$id) return false;

        $category = self::findOne($id);
        if (!$category) return false;

        $category->status = self::STATUS_DELETE;
        return $category->save();
    }

    /**
     * 获取所有有效的分类列表
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAllEnableCategory()
    {
        return self::find()
            ->where(['<>', 'status', self::STATUS_DELETE])
            ->asArray()
            ->all();
    }
}