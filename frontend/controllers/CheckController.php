<?php

namespace frontend\controllers;

use Yii;
use common\models\Katakunci;
use common\models\Rank;
use common\models\Domain;
use common\models\KatakunciSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use yii\filters\AccessControl;
/**
 * CheckController implements the CRUD actions for Katakunci model.
 */
class CheckController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
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

    /**
     * Lists all Katakunci models.
     * @return mixed
     */
    public function actionIndex()
    {
		date_default_timezone_set('Asia/Jakarta');
		$request = Yii::$app->request;
		if($request->isPost){
            $ketemu = "false";
			$id_user = Yii::$app->user->id; // id user yang sedang login;
			$keyword = $request->post('keyword');
			$domain = $request->post('domain');
			$cek = Katakunci::find()
			->where(['nama' => $keyword])
			->count();
			if($cek==0){
			$model = new Katakunci();
			$model->nama=$keyword;
			if ($model->validate()) {
				$model->save();
				}
			}
			$cek2 = Domain::find()
			->where(['nama' => $domain, 'id_user'=>$id_user])
			->count();
			if($cek2==0){
			$modeldomain = new Domain();
			$modeldomain->nama=$domain;
			$modeldomain->id_user=$id_user;
			if ($modeldomain->validate()) {
				$modeldomain->save();
				}
			}
			$qdomain = Domain::find()
			->where(['nama' => $domain, 'id_user' => $id_user])
			->all();
			foreach($qdomain as $id_domain)
			{
				$domainid = $id_domain->id; //domain_id
			}
			$googledata = Yii::$app->mycomponent->find($keyword,$domain);
            if (array_key_exists('ketemu', end($googledata))) {
                    $ketemu = "true";
                    array_pop($googledata);
            }
			$rankpos = end($googledata); // mencari index terakhir
			$ranking = $rankpos['rank']; // ranking halaman
			$halaman = $rankpos['url']; // halaman yang diranking
			array_pop($googledata);
			
			
			//find keyword id
			$key = Katakunci::find()
			->where(['nama' => $keyword])
			->all();
			foreach($key as $row)
			{
				$keyword_id = $row->id; //keyword_id
			}
			$models = new Rank();
            if($ketemu == "false"){
                $models->rank=99;
            }
            else{
			$models->rank=$ranking;
            }
			$models->id_keyword=$keyword_id;
			$models->id_user=$id_user;
			$models->id_domain=$domainid;
			$models->date = date('Y-m-d H:i:s');
			$models->time = date('Y-m-d H:i:s');
			if ($models->validate()) {
				$models->save();
				}
                        if($ketemu == "false"){
                                $halaman = 'tidak ditemukan pada top 100 ranking Google';
                                $ranking = 'n/a';
                            }
				return $this->render('result', [
        'keyword' => $keyword,
        'domain' => $domain,
        'ranking' => $ranking,
		'halaman' => $halaman,
		'kompetitor' => $googledata,
		]);
		}
        return $this->render('index');
    }

    /**
     * Displays a single Katakunci model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Katakunci model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Katakunci();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Katakunci model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Katakunci model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Katakunci model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Katakunci the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Katakunci::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
