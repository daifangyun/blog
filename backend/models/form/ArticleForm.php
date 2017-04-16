<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 13:28
 */

namespace backend\models\form;

use backend\models\ArticleModel;
use yii\base\Model;

class ArticleForm extends Model
{
    public $cid;
    public $title;
    public $abstract;
    public $content;
    public $id;
    public $status;


    private $_article;

    const SCENARIOS_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function rules()
    {
        return [
            ['id', 'required', 'message' => '{attribute}必须填写'],
            ['id', 'integer', 'min' => 1, 'max' => 11111111111, 'tooSmall' => '{attribute}不符合', 'tooBig' => '{attribute}不符合'],
            [['title', 'abstract', 'content', 'cid', 'status'], 'required', 'message' => '{attribute}必须填写'],
            [['title', 'abstract'], 'string', 'min' => 5, 'max' => 255, 'tooShort' => '{attribute}最少为5位', 'tooLong' => '{attribute}最长为255'],
            ['cid', 'integer', 'min' => 1, 'max' => 11111111111, 'tooSmall' => '{attribute}不符合', 'tooBig' => '{attribute}不符合'],
            ['status', 'in', 'range' => [ArticleModel::DISABLE_STATUS, ArticleModel::ENABLE_STATUS, ArticleModel::DELETE_STATUS], 'message' => '{attribute}不符合'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'cid' => '分类',
            'title' => '标题',
            'abstract' => '摘要',
            'content' => '详情',
        ];
    }

    /**
     * 设置场景
     * @return array
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIOS_CREATE] = ['title', 'abstract', 'content', 'cid', 'status'];
        $scenarios[self::SCENARIO_UPDATE] = ['id', 'title', 'abstract', 'content', 'cid', 'status'];
        return $scenarios;
    }

    /**
     * 创建文章
     * @return ArticleModel|bool
     */
    public function createArticle()
    {
        $articleModel = new ArticleModel();
        $articleModel->title = $this->title;
        $articleModel->abstract = $this->abstract;
        $articleModel->content = $this->content;
        $articleModel->cid = $this->cid;
        $articleModel->status = $this->status;
        if ($articleModel->save()) {
            return $articleModel;
        }
        return false;
    }

    /**
     * 根据id查找文章
     * @return static
     */
    public function findArticleById()
    {
        $this->_article = ArticleModel::findOne($this->id);
        return $this->_article;
    }

    /**
     * 修改文章
     * @return bool|static
     */
    public function updateArticle()
    {
        $article = $this->findArticleById();
        $article->title = $this->title;
        $article->abstract = $this->abstract;
        $article->content = $this->content;
        $article->cid = $this->cid;
        $article->status = $this->status;
        if ($article->save()) {
            return $this->_article;
        }
        return false;
    }
}