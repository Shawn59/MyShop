<?php

/**
 * Created by PhpStorm.
 * User: Shawn59
 * Date: 04.02.2018
 * Time: 0:28
 */
$this->pageTitle = Yii::app()->name . 'Редактирование записи';
$this->breadcrumbs = array('Изменени записи');
?>

<?php
 $form = $this->beginWidget('CActiveForm', array(
    'id' => 'edit_record',
     'enableClientValidation'=>true,
     'clientOptions'=>array(
         'validateOnSubmit'=>true,
     ),
 ));
?>

<div class="block-header">
    <?php if (isset($record->id)) {?>
    <h1> Изменение записи </h1>
    <?php } else {?>
    <h1> Новая запись </h1>
    <?php }?>
</div>
<div class="block-content">
    <div class="list">
        <div class="row">
            <div class="item-title">
                <h4>Заголовок записи</h4>
            </div>
        </div>
        <div class="row">
            <div class="item-input textField">
                <?php echo $form->textField($record, 'title', array('maxlength' => 70));?>
            </div>
        </div>
        <div class="row">
            <div class="item-title">
                <h4>Текст записи</h4>
            </div>
        </div>
        <div class="row">
            <div class="item-input description">
                <?php echo $form->textArea($record, 'text', array('maxlength' => 1000));?>
            </div>
        </div>
        <div class="row">
            <div class="item-input button">
                <?php echo CHtml::submitButton('Сохранить') ?>
            </div>
        </div>
    </div>
</div>
<div class="block-footer"> </div>

<?php
$this->endWidget();
?>
