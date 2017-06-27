<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel common\models\KatakunciSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riset Kata Kunci';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risetkatakunci-index">
<div class="card-panel red lighten-4">
    <center><h5><b>Riset Kata Kunci</b></h5></center>
    </div>

    <div class="section">
<ul class="collapsible popout" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons">live_help</i>Apa itu riset kata kunci ??</div>
      <div class="collapsible-body"><span>Riset kata kunci adalah kegiatan menemukan kata kunci yang potensial untuk dioptimasi dengan SEO, biasanya hal yang diperhatikan dalam riset kata kunci adalah volume pencarian perbulan, tingkat persaingan kata kunci, dan turunan kata kunci pada hasil pencarian masin pencari.
      <span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">navigation</i>Bagaimana cara kerja form dibawah ini ??</div>
      <div class="collapsible-body"><span>Cara kerja form dibawah adalah mencari data volume pencarian bulan ini dan 12 bulan kebelakang dari sebuah inputan kata kunci.</span></div>
    </li>
  </ul>
</div>

	<div class="row">
	<div class="col s12">
    <?php $form = ActiveForm::begin(); ?>
		<span>Kata Kunci</span>
        <input name="keyword" type="text" placeholder="masukan kata kunci" autofocus required>
    
        <div class="form-group">
          
            <button type="submit" class="btn btn primary" style="float:right">Submit<i class="material-icons right">send</i></button>
        </div>
    <?php ActiveForm::end(); ?>
	</div>
	</div>

</div>
