<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
echo $id;
echo "<br>";
echo $nama;
echo "<br>";
$form = ActiveForm::begin([
    'id' => 'rank-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= $form->field($model, 'id') ?>
    <?= $form->field($model, 'nama')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>