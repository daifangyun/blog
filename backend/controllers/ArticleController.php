<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 13:28
 */

namespace backend\controllers;

use backend\models\ArticleModel;
use backend\models\CategoryModel;
use backend\models\form\ArticleForm;
use yii\base\Exception;
use yii\data\Pagination;
use yii\helpers\Url;

class ArticleController extends BaseController
{
    /**
     * 获取文章列表
     * @return string
     */
    public function actionList()
    {
        $query = ArticleModel::find()->where(['<>', 'status', ArticleModel::DELETE_STATUS]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 10]);
        $articles = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list', ['articles' => $articles, 'pages' => $pages]);
    }

    /**
     * 创建文章
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ArticleForm();

        /**
         * 如果为get提交展示创建视图
         */
        if (\Yii::$app->request->isGet) {
            /**
             * 获取分类列表,因为标签是挂在分类下的
             */
            $categorys = CategoryModel::getAllEnableCategory();
            if (empty($categorys)) {
                $emptyCateogry = ['id' => 0, 'name' => '没有分类，请先去添加分类'];
                array_unshift($categorys, $emptyCateogry);
            }

            $model->status = 0;
            return $this->render('create', ['model' => $model, 'categorys' => $categorys]);
        }

        if (\Yii::$app->request->isPost) {
            /**
             * 获取分类列表,因为标签是挂在分类下的
             */
            $categorys = CategoryModel::getAllEnableCategory();
            if (empty($categorys)) {
                $emptyCateogry = ['id' => 0, 'name' => '没有分类，请先去添加分类'];
                array_unshift($categorys, $emptyCateogry);
            }

            $session = \Yii::$app->session;
            $model->setScenario($model::SCENARIOS_CREATE);
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                if ($model->createArticle()) {
                    $session->setFlash('formSuccess', '提交成功 ...');
                    return $this->redirect(Url::to([\Yii::$app->controller->id . '/create', true]));
                } else {
                    $session->setFlash('formError', '提交失败 ...');
                }
            } else {
                $session->setFlash('formError', '提交失败 ...');
            }

            return $this->render('create', ['model' => $model]);
        }

        throw new Exception('请求错误');
    }

    /**
     * 修改文章
     * @return string|\yii\web\Response
     */
    public function actionEdit()
    {
        /**
         * 如果为get提交,获取文章信息
         */
        if (\Yii::$app->request->isGet) {
            $id = (int)\Yii::$app->request->get('id');
            if (!$id) {
                return $this->goHome();
            }

            /**
             * 获取分类列表,因为标签是挂在分类下的
             */
            $categorys = CategoryModel::getAllEnableCategory();
            if (empty($categorys)) {
                $emptyCateogry = ['id' => 0, 'name' => '没有分类，请先去添加分类'];
                array_unshift($categorys, $emptyCateogry);
            }

            $formModel = new ArticleForm();
            $formModel->id = $id;
            $article = $formModel->findArticleById();

            if (!$article) {
                return $this->goHome();
            }

            $formModel->setAttributes($article->toArray());
            return $this->render('edit', ['model' => $formModel, 'categorys' => $categorys]);
        }

        /**
         * 如果为post提交,修改数据
         */
        if (\Yii::$app->request->isPost) {
            $session = \Yii::$app->session;
            $formModel = new ArticleForm();
            $formModel->setScenario(ArticleForm::SCENARIO_UPDATE);
            if ($formModel->load(\Yii::$app->request->post()) && $formModel->validate()) {
                if ($formModel->updateArticle()) {
                    $session->setFlash('formSuccess', '提交成功 ...');
                } else {
                    $session->setFlash('formError', '提交失败 ...');
                }
            } else {
                $session->setFlash('formError', '提交失败 ...');
            }

            /**
             * 获取分类列表,因为标签是挂在分类下的
             */
            $categorys = CategoryModel::getAllEnableCategory();
            if (empty($categorys)) {
                $emptyCateogry = ['id' => 0, 'name' => '没有分类，请先去添加分类'];
                array_unshift($categorys, $emptyCateogry);
            }

            return $this->render('edit', ['model' => $formModel, 'categorys' => $categorys]);
        }

        throw new Exception('请求错误');
    }

    /**
     * 删除文章
     * @return \yii\web\Response
     */
    public function actionDel()
    {
        if (\Yii::$app->request->isGet) {
            $id = \Yii::$app->request->get('id');
            if (!$id) {
                return $this->goHome();
            }
            $article = ArticleModel::findOne($id);

            if (!$article or $article->status == ArticleModel::DISABLE_STATUS) {
                return $this->goHome();
            }

            $article->status = ArticleModel::DELETE_STATUS;
            $session = \Yii::$app->session;
            if ($article->save()) {
                $session->setFlash('formSuccess', '提交成功 ...');
            } else {
                $session->setFlash('formError', '提交失败 ...');
            }

            return $this->redirect([\Yii::$app->controller->id . '/list']);
        } else {
            return $this->goBack();
        }
    }
}