<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Hubungi Kami';
$this->params['breadcrumbs'][] = 'Halaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
<div class="card-panel red lighten-4">
    <center><h5><b><?= Html::encode($this->title) ?></b></h5></center>
    </div>
    <br>
    <p>
        Jika Anda ada pertanyaan atau kerjasama, silahkan hubungi kami dengan mengisi form dibawah ini. Terima kasih.
    </p>
    <br>
    <div class="row">
        <div class="col s12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>



                <div class="form-group">
                    <button type="submit" class="btn btn primary" style="float:right">Submit<i class="material-icons right">send</i></button>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
