<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/12
 * Time: 10:45
 */

namespace backend\controllers;


use backend\models\CategoryModel;
use backend\models\form\CategoryForm;
use yii\data\Pagination;

class CategoryController extends BaseController
{
    /**
     * 创建
     * @return string
     */
    public function actionCreate()
    {
        $formModel = new CategoryForm();

        /**
         * 如果为get提交展示创建视图
         */
        if (\Yii::$app->request->isGet) {
            $formModel->status = 1;
            return $this->render('create', ['model' => $formModel]);
        }

        /**
         * 如果为post提交,做入库操作
         */
        if (\Yii::$app->request->isPost) {

            $session = \Yii::$app->session;

            $formModel->setScenario(CategoryForm::SCENARIOS_CREATE);
            if ($formModel->load(\Yii::$app->request->post())) {
                if ($formModel->create() !== false) {

                    $session->setFlash('formSuccess', '提交成功 ...');
                    return $this->redirect([\Yii::$app->controller->id . '/' . \Yii::$app->controller->action->id]);
                } else {
                    $session->setFlash('formError', '提交失败 ...');
                }
            } else {
                $session->setFlash('formError', '提交失败 ...');
            }

            return $this->render('create', ['model' => $formModel]);
        }
    }

    /**
     * 列表页
     * @return string
     */
    public function actionList()
    {
        $query = CategoryModel::find()->where(['<>', 'status', CategoryModel::STATUS_DELETE]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        $list = $query->orderBy('sort desc')->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('list', ['list' => $list, 'pages' => $pages]);
    }

    /**
     * 修改
     * @return string|\yii\web\Response
     */
    public function actionEdit()
    {
        $formModel = new CategoryForm();

        /**
         * 如果为get提交展示创建视图
         */
        if (\Yii::$app->request->isGet) {
            $id = (int)\Yii::$app->request->get('id');

            if (!$id) return $this->goBack();

            $formModel->id = $id;
            $category = $formModel->getCategoryById();
            if ($category === false) {
                return $this->goBack();
            }
            $formModel->name = $category->name;
            $formModel->pid = $category->pid;
            $formModel->sort = $category->sort;
            $formModel->status = $category->status;

            return $this->render('edit', ['model' => $formModel]);
        }

        /**
         * 如果为post提交,做入库操作
         */
        if (\Yii::$app->request->isPost) {

            $session = \Yii::$app->session;

            $formModel->setScenario(CategoryForm::SCENARIO_UPDATE);
            if ($formModel->load(\Yii::$app->request->post())) {
                if ($formModel->edit() !== false) {
                    $session->setFlash('formSuccess', '提交成功 ...');
                } else {
                    $session->setFlash('formError', '提交失败 ...');
                }
            } else {
                $session->setFlash('formError', '提交失败 ...');
            }

            return $this->render('edit', ['model' => $formModel]);
        }
    }

    /**
     * 删除
     * @return \yii\web\Response
     */
    public function actionDel()
    {
        $id = (int)\Yii::$app->request->get('id');

        if (!$id) return $this->goBack();

        $delRs = CategoryModel::delById($id);

        $session = \Yii::$app->session;
        if ($delRs) {
            $session->setFlash('formSuccess', '提交成功 ...');
        } else {
            $session->setFlash('formError', '提交失败 ...');
        }
        return $this->redirect([\Yii::$app->controller->id . '/list']);
    }
}