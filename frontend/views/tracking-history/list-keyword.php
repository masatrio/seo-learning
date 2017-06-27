<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KatakunciSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Kata Kunci';
$this->params['breadcrumbs'][] = 'Tracking History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-panel red lighten-4">
    <center><h5><b>List Kata Kunci</b></h5></center>
    </div>
    <div class="row">
<?php
	foreach ($rank as $rankdata) {
		echo '<div class="col l4 s12">';
		echo '<div class="collection">';
		$id = $rankdata['id_keyword']-1;
	//	echo $listkeyword[$id]['nama'];
		echo '<p class="collection-item"><a href="/tracking-history/history?domainid='.$domainid.'&keywordid='.$rankdata['id_keyword'].'">'.$listkeyword[$id]['nama'].'</a></p>';
		echo '</div></div>';}
		?>
	</div>

		

