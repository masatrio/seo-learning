<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KatakunciSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hasil Tracking';
$this->params['breadcrumbs'][] = 'Cek Posisi Kata Kunci';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-panel red lighten-4">
    <center><h5><b>Hasil Tracking</b></h5></center>
    </div>
<div>
<div class="collection">
<?php
    echo '<p class="collection-item">Kata Kunci = '.$keyword.'</p>';
    echo '<p class="collection-item">Domain = '.$domain.'</p>';
    echo '<p class="collection-item">Ranking = '.$ranking.'</p>';
    echo '<p class="collection-item">Halaman = '.$halaman.'</p>';
    ?>
  </div>
<div class="card-panel red lighten-4">
    <center><h5><b>Website Kompetitor</b></h5></center>
    </div>
    <div class="collection">
    <?php
foreach ( $kompetitor as $data ){
	echo '<p class="collection-item">';
		   echo "[".$data['rank']."]";
		   echo " => ";
		   echo $data['url'];
		   echo '</p>';
		   if($data['rank']==10){
		   	break;
		   }
	   }
?>
</div>
<div class="katakunci-index">

    <?php $form = ActiveForm::begin(); ?>
		Kata Kunci
        <input name="keyword" type="text" autofocus >
		Domain
		<input name="domain" type="text">

    
        <div class="form-group">
            <button type="submit" class="btn btn primary" style="float:right">Submit<i class="material-icons right">send</i></button>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<br><br>
