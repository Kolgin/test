<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\MailerForm */

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;


$this->title = 'Анкета оценки имущества';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('mailerFormSubmitted')) : ?>

        <div class="alert alert-success">
            Ваше письмо отправлено!
        </div>

    <?php else : ?>

        <p>
            Заполните анкету оценки!
        </p>

        <div class="row">
            <div class="col-lg-12">

                <?php $form = ActiveForm::begin(['id' => 'mailer-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'fromName') ?>

                <?= $form->field($model, 'fromEmail') ?>

                <?= $form->field($model, 'subject') ?>

                <div class="col-lg-3">
                    <?= $form->field($model, 'passportFace')->fileInput(); ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'passportMade')->fileInput(); ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'passportRegistration')->fileInput(); ?>
                </div><br><br><br><br>

                <div class="col-lg-12">
                    <?= $form->field($model, 'idСodeFace')->fileInput(); ?>
                </div><br><br><br><br>

                <div class="col-lg-12">
                    <?= $form->field($model, 'interPassportFace')->fileInput(); ?>
                </div><br><br><br><br>

                <div class="col-lg-3">
                    <?= $form->field($model, 'propertyRightsOne')->fileInput(); ?>
                </div>
                <div class="col-lg-9">
                    <?= $form->field($model, 'propertyRightsTwo')->fileInput(); ?>
                </div><br><br><br><br>

                <div class="col-lg-3">
                    <?= $form->field($model, 'techPassport1')->fileInput(); ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'techPassport2')->fileInput(); ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'techPassport3')->fileInput(); ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'techPassport4')->fileInput(); ?>
                </div><br><br><br><br>

                <div class="col-lg-12">
                    <?= $form->field($model, 'techPassport5')->fileInput(); ?>
                </div>

                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    <?php endif; ?>
</div>