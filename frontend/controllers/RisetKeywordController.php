<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RisetKeywordController extends Controller
{
    public function actionIndex()
    {
		$request = Yii::$app->request;
			if($request->isPost){
			$keyword = $request->post('keyword');
			$client = new Yii::$app->apicomponent();
			$post_array[] = array(
			"language" => "id",
			"loc_name_canonical"=> "Indonesia",
			"key" => $keyword
			);
			$sv = array();
			$sv_post_result = $client->post('v2/kwrd_sv', array('data' => $post_array));
			$year = date('Y');
				foreach ($sv_post_result['results'] as $i => $sv_post) {
				$sv[] = [
				"month" => date('n'),
				"year" => $year,
				"ms" => $sv_post['sv'],
				];
		foreach($sv_post['ms'] as $i => $sv_post){
			if($sv_post['month']==12){
				$year = $year - 1;
			}
			$sv[] = [
				"month" => $sv_post['month'],
				"year" => $year,
				"ms" => $sv_post['count'],
				];
		}
	}
		$keywords = array();
		$suggest = file_get_contents('http://suggestqueries.google.com/complete/search?output=chrome&client=chrome&hl=en-ID&q='.urlencode($keyword));
		if (($suggest = json_decode($suggest, true)) !== null) {
        $suggests = $suggest[1];
		}
		//menghitung rata2
		$jumlah=0;
		foreach($sv as $data){
			$jumlah = $jumlah + $data['ms'];
		}
		$mean = $jumlah/13;
		//menghitung standar deviasi
		$jumlah1 = 0;
		foreach($sv as $data){
			$a = pow(($data['ms']-$mean),2);
			$jumlah1 = $jumlah1 + $a;
		}
		$sd = sqrt($jumlah1/13);
		//menentukan kriteria volume pencarian
		if((int)$mean<1000){
			$kriteria = 'rendah';
		}
		else if((int)$mean>=1000 && $mean<=2000){
			$kriteria = 'sedang';
		}else if((int)$mean>2000){
			$kriteria = 'tinggi';
		}
        return $this->render('result',
		['data' => $sv,
		 'keyword' => $keyword,
		 'suggest' => $suggests,
		 'mean' => $mean,
		 'sd' => $sd,
		 'kriteria' => $kriteria]
		);
    }
	return $this->render('index');
	}
}
