<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 12:55
 */

namespace backend\models\form;

use backend\models\CategoryModel;
use yii\base\Model;

class CategoryForm extends Model
{
    public $id;
    public $name;
    public $pid;
    public $sort;
    public $status;

    private $_category;

    const SCENARIOS_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function rules()
    {
        return [
            ['name', 'required', 'message' => '{attribute} 必须填写'],
            ['name', 'string', 'min' => '1', 'max' => '25', 'tooShort' => '{attribute} 长度在1-25位', 'tooLong' => '{attribute} 长度在1-25位'],
            ['sort', 'integer', 'message' => '{attribute} 必须为整数'],
            ['id', 'required', 'message' => '{attribute} 必须填写'],
            ['id', 'integer', 'message' => '{attribute} 错误'],
            ['status', 'required', 'message' => '{attribute} 必须填写'],
            ['status', 'in', 'range' => [CategoryModel::STATUS_ENABLE, CategoryModel::STATUS_DISABLE], 'message' => '{attribute} 填写错误'],
        ];
    }

    /**
     * 设置场景
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIOS_CREATE] = ['name', 'sort', 'status'];
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'name', 'sort', 'status'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'pid' => '父级',
            'sort' => '排序',
            'status' => '状态',
        ];
    }

    /**
     * 创建分类
     * @return bool
     */
    public function create()
    {
        if ($this->validate()) {
            $model = new CategoryModel();
            $model->name = $this->name;
            $model->pid = $this->pid ?: 0;
            $model->sort = $this->sort ?: 0;
            $model->status = $this->status;
            return $model->save();
        }
        return false;
    }

    /**
     * 根据id获取分类
     * @return bool|static
     */
    public function getCategoryById()
    {
        if (!$this->id) {
            return false;
        }
        $this->_category = CategoryModel::findOne($this->id);
        return $this->_category;
    }

    /**
     * 修改分类
     * @return bool
     */
    public function edit()
    {
        if ($this->validate()) {
            $model = $this->getCategoryById();
            if ($model === false) {
                return false;
            }
            $model->name = $this->name;
            $model->pid = $this->pid ?: 0;
            $model->sort = $this->sort ?: 0;
            $model->status = $this->status;
            return $model->save();
        }
        return false;
    }
}