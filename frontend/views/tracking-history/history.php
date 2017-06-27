<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Grafik Riwayat Rangking';
$this->params['breadcrumbs'][] = 'Tracking History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-panel red lighten-4">
    <center><h5><b>Grafik Riwayat Rangking Kata Kunci</b></h5></center>
    </div>
    <?php
$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "April", 5 => "Mei", 6 => "Jun", 7 => "July", 8 => "Aug", 9 => "Sept", 10 => "Octo", 11 => "Nov", 12 => "Des");
$values = array();
$values[] = array('Task', 'Ranking');
foreach($data as $datas){
	$month_name = $mons[$datas['month']];
	$values[] = array($month_name.' '.$datas['year'],(int)$datas['rank']);
}
$pisahkalimat= explode(" ", $keywordname);
foreach ($pisahkalimat as $kalimat) {
	//jadikan awal huruf masing2 array menjadi huruf besar dengan fungsi ucfirst
$kalimatawalhurufbesar=ucfirst(strtolower($kalimat));
$kalimatbaru[] = $kalimatawalhurufbesar;
}
$textgood = implode(" ", $kalimatbaru);
echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => $values,
                'options' => array('title' => 'Grafik Riwayat Ranking Website "'.$namadomain.'" dengan Kata Kunci "'.$textgood.'"')));
				?>