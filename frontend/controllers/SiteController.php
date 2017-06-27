<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\UserForm;
use common\models\Rank;
use common\models\Post;
use common\models\Katakunci;
use yii\helpers\Html;
use common\components\phpQuery\phpQueryone;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
	 public function actionGoo()
    {
       $googledata = Yii::$app->mycomponent->find('buah','dedaunan.com');
	   foreach ( $googledata as $data ){
		   echo $data['rank'];
		   echo $data['url'];
	   }
    }
	 public function actionCheck()
{
	$country = "id";
	$firstnresults = 50;
	$rank = 0;
    $urls = Array();
    $pages = ceil($firstnresults / 10);
	$request = Yii::$app->request;
	$keyword = "kosong";
	$domain = "kosong";
    if($request->isPost){
			$keyword = $request->post('keyword');
			$domain = $request->post('domain');
			for($p = 0; $p < $pages; $p++){
        $start = $p * 10;
        $baseurl = "https://www.google.co.id/search?output=search&start=".$start."&q=".urlencode($keyword);
        $html = file_get_contents($baseurl);
        $doc = phpQuery::newDocument($html);

        foreach($doc['#ires cite'] as $node){
            $rank++;
            $url = $node->nodeValue;
			$urlranks[] = $url;
            $urls[] = "[".$rank."] => ".$url;
            if(stripos($url, $domain) !== false){
                break(2);
            }
        }
	}
	//$urlrank = array_pop($urlranks);
	//array_pop($urls);
         return $this->render('index', [
		'keyword' => $keyword,
		'domain' => $domain,
    ]);
   }	

    return $this->render('check', [
		'keyword' => $keyword,
		'domain' => $domain,
    ]);
}

	public function actionRank(){
		 $model = new Rank();
		 $request = Yii::$app->request;
		 $message="";
		 $id=0;
		 $nama="";
		 /*for post request*/
		 	//if($request->isPost){
			//$model = new Rank();
			//$id = $request->post('id');
			//$nama = $request->post('nama');
			//$model->id = 4;
			//$model->nama = "james";
			//$model->save();
			//$message ="success";
			
		//}
		 if ($model->load(Yii::$app->request->post())) {
			 $check = Rank::find()
			->where( [ 'nama' => $model->nama ] )
			->exists(); 
			 if($check==1){
				 return $this->render('rank', ['message' => $message,'model' => $model, 'id'=>$model->id, 'nama'=>$model->nama]);
			 }
			 else{
			if ($model->validate()) {
				if($model->save()){
					Yii::$app->session->setFlash('success', 'Success');
					return $this->render('rank', ['message' => $message,'model' => $model, 'id'=>$model->id, 'nama'=>$model->nama]);					
							}
						}
					}
			}

		 return $this->render('rank', ['message' => $message,'model' => $model, 'id'=>$id, 'nama'=>$nama]);
	 }
	 

	 public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	 
	 
	 public function actionSidebar(){
		 $categories = \common\models\Category::find()
	->orderBy('name ASC')
	->all();
	return $this->render('sidebar', [
        'categories' => $categories,
    ]);
	 }
	 public function actionPostSingle($id){

	
		 $model = new \common\models\Comment();
		 $posts = \common\models\Post::find()
	->where(['status' => 1,'id'=>$id])
	->orderBy('id DESC')
	->limit(1)
	->all();
		$categories = \common\models\Category::find()
	->orderBy('name ASC')
	->all();
		 $comments = \common\models\Comment::find()
                ->where(['status' => 1,'post_id'=>$id])
                ->orderBy('id DESC')
                ->all();
	
	if ($model->load(Yii::$app->request->post())) {
    $model->post_id=$id;
    $model->status=0;
    $model->create_time=time();
    if ($model->validate()) {
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Comment saved, waiting moderation');
        }
    }
}

		return $this->render('postSingle', [
        'posts' => $posts,
        'categories' => $categories,
        'comments' => $comments,
		'model' => $model,
		'ono' => $ono,
    ]);
	 }
	 
	 public function actionIndex()
 {
 $posts = \common\models\Post::find()
 ->where(['status' => 1])
 ->orderBy('id DESC')
 ->limit(5)
 ->all();
$categories = \common\models\Category::find()
 ->orderBy('name ASC')
 ->all();
 //mengembalikan ke halaman login
 //if ( Yii::$app->user->isGuest )
   //return Yii::$app->getResponse()->redirect(\Yii::$app->getUser()->loginUrl);
return $this->render('index', [
 'posts' => $posts,
 'categories' => $categories,
 ]);
 }
 
 public function actionPostCategory($id)
{
$posts = \common\models\Post::find()
->where(['status' => 1, 'category_id' => $id])
->orderBy('id DESC')
->limit(5)
->all();
$categories = \common\models\Category::find()
->orderBy('name ASC')
->all();
return $this->render('postCategory', [
'posts' => $posts,
'categories' => $categories,
]);
}
 
 
	 public function actionUser(){
		$model = new UserForm;
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			yii::$app->session->setFlash('success','you have entered the data correctly');
		}
		return $this->render('user',['model'=>$model]);
		}
		
		public function actionHubungi()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
	
	
		
	 public function actionHello(){
		 return $this->render('hello');
	 }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    
 
 
	
	
	

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
       return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
