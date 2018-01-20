<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Регистрация пользователя';
//хлебные крошки - список ссылок
$this->breadcrumbs=array(
	'Регистрация',
);
?>

<h1>Регистрация пользователя</h1>

<?php if(Yii::app()->user->hasFlash('reg')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('reg'); ?>
</div>

<?php else: ?>

    <?php if($model->getErrors()) {?>

        <div class="flash-error">
            <?php echo var_dump($model->getErrors()); ?>
        </div>
        <?php }?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model);
	// labelEx - звёздочки
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login'); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FIO'); ?>
		<?php echo $form->textField($model,'FIO',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'FIO'); ?>
	</div>

	<?php if (CCaptcha::checkRequirements()) {?>
	<div class="row">
		<div>
		<?php $this->widget('CCaptcha'); ?>
		</div>
		<div class="hint" style="padding-bottom: 10px; padding-top: 10px;">Пожалуйста, введите буквы, как они показаны на рисунке выше.
		<br/>Буквы не чувствительны к регистру.
        </div>
        <div>
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <?php echo $form->textField($model,'verifyCode'); ?>
        </div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php }; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Зарегистрироваться'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>