<?php

namespace frontend\controllers;
use Yii;
use common\models\Katakunci;
use common\models\Rank;
use common\models\Domain;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TrackingHistoryController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','history','list-keyword'],
                'rules' => [
                    [
                        'actions' => ['index','history','list-keyword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
    	$id_user = Yii::$app->user->id;
    	$message = 'true';
    	$cek1 = Domain::find()
			->where(['id_user'=>$id_user])
			->count();
			if($cek1==0){
				$message = 'false';
				return $this->render('index', [
        		'message' => $message,
				]);
			}
			$domain = Domain::find()
			->where(['id_user'=>$id_user])
			->all();
        	return $this->render('index', [
        		'message' => $message,
        		'domain' => $domain,
				]);
    }
    public function actionListKeyword()
    {
    	$request = Yii::$app->request;
    	$domainid = $request->get('id');
    	$keyword = Katakunci::find()
            ->select('nama')
            ->asArray()
			->all();
    	$rank = Rank::find()
    		->select('id_keyword')->distinct()
    		->where(['id_domain'=>$domainid])
            ->asArray()
			->all();
    	return $this->render('list-keyword', [
        		'rank' => $rank,
        		'listkeyword' => $keyword,
                'domainid' => $domainid
				]);
    }
    public function actionHistory()
    {
        $request = Yii::$app->request;
        $domainid = $request->get('domainid');
        $keywordid = $request->get('keywordid');
        $keyword = Katakunci::find()
            ->select('nama')
            ->asArray()
            ->all();
        $keywordname = $keyword[$keywordid-1];
        $namadomain = Domain::find()
            ->select('nama')
            ->where(['id'=>$domainid])
            ->asArray()
            ->all();
        $namadomain = $namadomain[0]['nama'];
        $keywordname = $keywordname['nama'];
        $rank = Rank::find()
            ->select('rank,YEAR(date) AS year,MONTH(date) AS month')
            ->where(['id_domain'=>$domainid,'id_keyword'=>$keywordid])
            ->orderBy(['date'=>'ASC'])
            ->limit(10)
            ->asArray()
            ->all();
             return $this->render('history',
        ['data' => $rank, 'keywordname' => $keywordname, 'namadomain' => $namadomain]
        );
    }
}
