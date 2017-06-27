<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = 'Page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<div class="card-panel red lighten-4">
    <center><h5><b><?= Html::encode($this->title) ?></b></h5></center>
    </div>
    <br>
    <p>Silahkan isi form dibawah ini untuk login : </p>
    <br>
    <div class="row">
        <div class="col s12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>



                <div style="color:#999;margin:1em 0">
                    Lupa password? <?= Html::a('Reset password', ['site/request-password-reset']) ?>.
                    <div class="form-group">
                    <button type="submit" class="btn btn primary" style="float:right">Login<i class="material-icons right">send</i></button>
                </div>
                </div>

                

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
