<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::addJsFile($this, [
    "plugins/ueditor/ueditor.config.js",
    "plugins/ueditor/ueditor.all.min.js",
    "plugins/ueditor/lang/zh-cn/zh-cn.js",
]);

$this->title = '添加文章';
?>
<div class="site-index">
    <?php $this->beginBlock('content-header'); ?>
    <?= \backend\widget\BreadcrumbWidget::widget([
        'level' => [
            '文章管理' => Url::to([Yii::$app->controller->id . '/list']),
        ],
        'active' => '添加文章',
    ]); ?>
    <?php $this->endBlock(); ?>
    <div class="body-content">

        <div class="row">
            <div class="box-body">
                <form role="form"
                      action="<?= Url::to([Yii::$app->controller->id . '/' . Yii::$app->controller->action->id]) ?>"
                      method="post">

                    <div class="form-group">
                        <label>文章标题</label>
                        <?= Html::activeTextInput($model,'title', ['class' => 'form-control', 'placeholder' => '文章标题 ...']); ?>
                        <span class="help-block m-b-none">
                            <?= $model->getFirstError('title'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label>文章摘要</label>
                        <?= Html::activeTextarea($model, 'abstract', ['class' => 'form-control', 'placeholder' => '文章摘要 ...']); ?>
                        <span class="help-block m-b-none">
                            <?= $model->getFirstError('abstract'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <label>文章详情</label>
                        <?= Html::activeTextarea($model, 'content', ['id' => 'editor', 'type' => 'text/plain', 'style' => 'width:100%;height:450px;']); ?>
                        <span class="help-block m-b-none">
                            <?= $model->getFirstError('content'); ?>
                        </span>
                    </div>

                    <div class="form-group">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken); ?>
                        <?= Html::submitButton('保存内容', ['class' => 'btn btn-primary pull-right']); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('myJs'); ?>
<script>
    $(function () {
        var ue = UE.getEditor('editor', {
//            serverUrl: imageUploadUrl
        });
    });

</script>

<?php $this->endBlock(); ?>
