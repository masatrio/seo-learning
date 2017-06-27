<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KatakunciSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tracking History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-panel red lighten-4">
    <center><h5><b>Tracking History</b></h5></center>
    </div>
    <div class="section">
<ul class="collapsible popout" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons">live_help</i>Apa itu tracking history ??</div>
      <div class="collapsible-body"><span>Tracking history adalah kegiatan untuk melihat riwayat rangking website untuk kata kunci tertentu. Kegiatan ini berfungsi untuk melihat pola rangking website kita untuk kata kunci tertentu, sehingga dengan data yang ada diharapkan dapat memprediksi rangking di masa mendatang dan dapat segera merencanakan kegiatan SEO selanjutnya untuk website Anda.
      <span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">navigation</i>Bagaimana cara kerja tracking history ??</div>
      <div class="collapsible-body"><span>Cara kerja tracking history adalah dengan menampilkan website yang sudah Anda cek rangkingnya, lalu saat salah satu list website di klik maka akan menampilkan kata kunci yang pernah di cek untuk website tersebut, selanjutnya jika kata kunci di klik maka akan menampilkan grafik riwayat rangking kata kunci. Angka 99 pada grafik menunjukkan bahwa website tidak ditemukan pada top 100 hasil penelusuran Google.</span></div>
    </li>
  </ul>
</div>
    <div class="row">
<?php
if($message=='false'){
	echo 'maaf belum ada riwayat tracking yang dilakukan.';
}
else{
	foreach($domain as $domaindata){
		echo '<div class="col l4 s12">';
		echo '<div class="collection">';
		echo '<p class="collection-item"><a href="/tracking-history/list-keyword?id='.$domaindata['id'].'">'.$domaindata['nama'].'</a></p>';
		echo '</div></div>';
	}
}
?>
</div>

