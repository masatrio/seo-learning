<?php

namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Post;

class SeoOnpageController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$posts = Post::find()
		->where(['status' => 1, 'category_id' => 3])
		->orderBy('id ASC')
		->all();
        return $this->render('index', [
							 'posts' => $posts,
							]);
    }

}
