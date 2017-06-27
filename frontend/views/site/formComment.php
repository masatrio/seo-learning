<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form ActiveForm */
?>
<br><br>
<div class="site-formComment">
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'author')->textinput(['style'=>'width:50%;']) ?>
<?= $form->field($model, 'email')->textinput(['style'=>'width:50%;']) ?>
<?= $form->field($model, 'url') ?>
<?= $form->field($model, 'content')->textarea(['rows'=>3]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn waves-effect waves-light']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-formComment -->
