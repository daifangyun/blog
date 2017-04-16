<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/11
 * Time: 11:02
 */

namespace backend\widget;

/**
 * 后台表单提交后的提示小组件
 */
use yii\base\Widget;

class BreadcrumbWidget extends Widget
{
    public $level;

    public $active;


    public function run()
    {
        return $this->render('breadcrumb', ['level' => $this->level, 'active' => $this->active]);
    }
}