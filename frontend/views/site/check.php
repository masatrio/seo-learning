<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Katakunci */
/* @var $form ActiveForm */
?>
<div class="formKatakunci">
	<?php
	echo $keyword;
	echo $domain;?>
    <?php $form = ActiveForm::begin(); ?>
	
        <input name="keyword" type="text">
		<input name="domain" type="text">

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- formKatakunci -->
