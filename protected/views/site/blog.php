<?php

/**
 * Created by PhpStorm.
 * User: Shawn59
 * Date: 22.01.2018
 * Time: 20:03
 */

$this->pageTitle = Yii::app()->name . 'Создание блога';
?>


    <div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'blogForm-from',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
        <div class="list">
            <div class="row">
                <div class="title">
                    <h2>
                        <?php
                            if (!Yii::app()->user->isGuest) {
                                echo "Добро пожаловать на блог пользователя : " .  Yii::app()->user->name;
                            } else {
                                echo "Добро пожаловать";
                            }
                        ?>
                    </h2>
                </div>
            </div>
            <?php if (isset($blog)) {?>
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
            <div class="list">
                <div class="row">
                    <div class="title">
                        <h4>Записи</h4>
                    </div>
                </div>
                <?php if ($records) {
                    foreach ($records as $record) {
                    ?>
                <div class="row">
                    <div class="record">
                        <div class="title">
                            <?php $d = $record->title; echo $form->label($record, $d);?>
                        </div>
                        <div class="text">
                            <?php echo $form->label($record, $record->text);?>
                        </div>
                        <div class="title-text">
                            <h5>коментарии:</h5>
                        </div>
                        <div class="comment">
                            <?php echo $form->textArea($comment, 'text', array('maxlength' => 255));?>
                        </div>
                        <div class="row buttons addComment">
                            <?php echo CHtml::submitButton('Добавить'); ?>
                        </div>
                    </div>
                </div>
                <?php }}?>
            </div>
        <?php }?>
<?php $this->endWidget(); ?>
    </div>
