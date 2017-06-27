<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use scotthuangzl\googlechart\GoogleChart;
$this->title = 'Hasil Riset Kata Kunci';
$this->params['breadcrumbs'][] = 'Riset Kata kunci';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-panel red lighten-4">
    <center><h5><b>Hasil Riset Kata Kunci</b></h5></center>
    </div>				
<?php
$mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "April", 5 => "Mei", 6 => "Jun", 7 => "July", 8 => "Aug", 9 => "Sept", 10 => "Octo", 11 => "Nov", 12 => "Des");
$values = array();
$values[] = array('Task', 'Volume Pencarian Per Bulan');
foreach(array_reverse($data) as $datas){
	$month_name = $mons[$datas['month']];
	$values[] = array($month_name.' '.$datas['year'],$datas['ms']);
}
$pisahkalimat= explode(" ", $keyword);
foreach ($pisahkalimat as $kalimat) {
	//jadikan awal huruf masing2 array menjadi huruf besar dengan fungsi ucfirst
$kalimatawalhurufbesar=ucfirst(strtolower($kalimat));
$kalimatbaru[] = $kalimatawalhurufbesar;
}
$textgood = implode(" ", $kalimatbaru);
echo GoogleChart::widget(array('visualization' => 'LineChart',
                'data' => $values,
                'options' => array('title' => 'Grafik Data Volume Pencarian Google dengan Kata Kunci "'.$textgood.'"')));
				?>
				<br>
				<div class="well">
				<b>Kriteria Kata Kunci</b><br>
				rata - rata volume pencarian = <?php echo (int)$mean;?>  <span class="glyphicon glyphicon-question-sign tooltipped" data-tooltip="Nilai berikut merupakan nilai rata-rata dari data volume pencarian diatas."></span>
				<br>
				kriteria volume pencarian = <?php echo $kriteria; ?>  <span class="glyphicon glyphicon-question-sign tooltipped" data-tooltip="volume < 1000 : rendah, 1000 <= volume <= 2000 : sedang, volume > 2000 : tinggi"></span><br>
				standar deviasi = <?php echo (int)$sd;?>  <span class="glyphicon glyphicon-question-sign tooltipped" data-tooltip="Nilai berikut merupakan nilai standar deviasi, semakin besar nilainya maka semakin fluktuatif pola datanya dan semakin kecil nilainya maka pola datanya cenderung stabil."></span>
				</div>
				<div class="card-panel red lighten-4">
    <center><h5><b>Kata Kunci Terkait</b></h5></center>
    </div>
    <div class="well">
    Berikut merupakan kata kunci turunan yang berhubungan dengan kata kunci utama, Anda dapat menggunakannya untuk optimasi dan Anda dapat cek data volume pencarian dengan menekan tombol disamping kanan.
    </div>
    <ul class="collection">
				<?php
				//$suggestion = implode('<br>', $suggest);
				//echo $suggestion;
				foreach($suggest as $suggestion){
					echo '<li class="collection-item">';
					echo '<div>'.$suggestion; ?>
					<?= Html::a('<i class="material-icons">send</i>', 
    ['/riset-keyword/index'], [
    'data-method' => 'POST',
    'class' => 'secondary-content',
    'alt' => 'cek data',
    'title' => 'cek data',
    'data-params' => [
        'keyword' => $suggestion,
    ],
]) ?>
<?php
					echo '</div></li>';
				}
				?>      
      </ul>
				<br><br>
				<div class="row">
				<div class="col s12">
    <?php $form = ActiveForm::begin(); ?>
		Kata Kunci
        <input name="keyword" type="text" placeholder="masukan kata kunci" autofocus required>
		
        <div class="form-group">
            <button type="submit" class="btn btn primary" style="float:right">Submit<i class="material-icons right">send</i></button>
        </div>
    <?php ActiveForm::end(); ?>
	</div>
	</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
