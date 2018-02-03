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
    <h1> Изменение записи </h1>
    <h1> Новая запись </h1>
</div>
<div class="block-content">
    <div class="list">
        <div class="row">
            <div class="title">
                <h4>Информация</h4>
            </div>
        </div>
        <div class="row">
            <div class="description">
                <?php echo $form->textArea($blog, 'title', array('maxlength' => 255));?>
            </div>
        </div>
    </div>
</div>
<div class="block-footer"> </div>

<?php
$this->endWidget();
?>

