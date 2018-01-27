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
        <?php if (isset($model)) {?>
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
            <div class="row">
                <div class="description">
                    <?php echo $form->textArea($model, 'title', array('maxlength' => 30));?>
                </div>
            </div>
        </div>
        <?php }?>
        <!--<div class="row">
            <?php /*echo $form->labelEx($model,'login'); */?>
            <?php /*echo $form->textField($model,'login'); */?>
            <?php /*echo $form->error($model,'login'); */?>
        </div>

        <div class="row">
            <?php /*echo $form->labelEx($model,'password'); */?>
            <?php /*echo $form->passwordField($model,'password'); */?>
            <?php /*echo $form->error($model,'password'); */?>
        </div>-->
<?php $this->endWidget(); ?>
    </div>
