<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '修改分类 ...';
?>
<div class="site-index">
    <?php $this->beginBlock('content-header'); ?>
    <?= \backend\widget\BreadcrumbWidget::widget([
        'level' => ['分类列表' => Url::to([Yii::$app->controller->id . '/list'])],
        'active' => '修改分类',
    ]); ?>
    <?php $this->endBlock(); ?>
    <div class="body-content">
        <?= \backend\widget\FormAlertWidget::widget(); ?>

        <div class="row">
            <div class="box-body">
                <form role="form"
                      action="<?= Url::to([Yii::$app->controller->id . '/' . Yii::$app->controller->action->id]) ?>"
                      method="post">

                    <div class="form-group <?= ($nameError = $model->getFirstError('name')) ? 'has-error' : '' ?>">
                        <label class="control-label" for="name">
                            <?= $nameError ? '<i class="fa fa-times-circle-o"></i>' : '' ?>
                            分类名称
                        </label>
                        <?= Html::activeTextInput($model, 'name', ['id' => 'name', 'class' => 'form-control', 'placeholder' => '分类名称 ...']); ?>
                        <?= $nameError ? '<span class="help-block m-b-none">' . $nameError . '</span>' : '' ?>
                    </div>

                    <div class="form-group <?= ($sortError = $model->getFirstError('sort')) ? 'has-error' : '' ?>">
                        <label class="control-label" for="sort">
                            <?= $sortError ? '<i class="fa fa-times-circle-o"></i>' : '' ?>
                            排序
                        </label>
                        <?= Html::activeTextInput($model, 'sort', ['id' => 'sort', 'class' => 'form-control', 'placeholder' => '排序 ...']); ?>
                        <?= $sortError ? '<span class="help-block m-b-none">' . $sortError . '</span>' : '' ?>
                    </div>

                    <div class="form-group">
                        <div class="radio">
                            <?= Html::activeRadioList($model, 'status', ['1' => '启用', '0' => '禁用']) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::activeHiddenInput($model, 'id'); ?>
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
</script>

<?php $this->endBlock(); ?>
