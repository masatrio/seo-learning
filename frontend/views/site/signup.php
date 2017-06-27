<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = 'Page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
<div class="card-panel red lighten-4">
    <center><h5><b><?= Html::encode($this->title) ?></b></h5></center>
    </div>
    <br>
    <p>Silahkan isi form dibawah ini untuk mendaftar :</p>
    <br>
    <div class="row">
        <div class="col s12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>

                <?= $form->field($model, 'email')->textInput(['autocomplete' => 'off']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <button type="submit" class="btn btn primary" style="float:right">Register<i class="material-icons right">send</i></button>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
