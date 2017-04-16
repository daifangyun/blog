<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = '文章列表';
?>
<div class="site-index">
    <?php $this->beginBlock('content-header'); ?>
    <?= \backend\widget\BreadcrumbWidget::widget([
        'level' => [
            '文章管理' => Url::to([Yii::$app->controller->id . '/list']),
        ],
        'active' => '文章列表',
    ]); ?>
    <?php $this->endBlock(); ?>
    <div class="body-content">
        <?= \backend\widget\FormAlertWidget::widget(); ?>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <a role="button" href="<?= Url::to([Yii::$app->controller->id . '/create']); ?>"
                           class="btn-sm btn-default pull-right">添加文章</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>标题</th>
                                <th>查看次数</th>
                                <th>添加时间</th>
                                <th>操作</th>
                            </tr>
                            <?php foreach ($articles as $k => $v): ?>
                                <tr>
                                    <td><?= ++$k ?></td>
                                    <td><?= $v['title'] ?></td>
                                    <td><?= $v['look'] ?></td>
                                    <td><?= date('Y-m-d H:i:s', $v['created_at']) ?></td>
                                    <td>
                                        <a role="button" class="btn btn-info"
                                           href="<?= Url::to([Yii::$app->controller->id . '/edit', 'id' => $v['id']]) ?>">修改</a>
                                        <a role="button" class="btn btn-danger"
                                           href="<?= Url::to([Yii::$app->controller->id . '/del', 'id' => $v['id']]) ?>">删除</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="pull-right">
                                        <?= \yii\widgets\LinkPager::widget([
                                            'pagination' => $pages,
                                            'nextPageLabel' => '下一页',
                                            'prevPageLabel' => '上一页',
                                            'firstPageLabel' => '首页',
                                            'lastPageLabel' => '尾页',
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('myJs'); ?>

<?php $this->endBlock(); ?>
