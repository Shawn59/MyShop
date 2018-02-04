<?php
/**
 * Created by PhpStorm.
 * User: Shawn59
 * Date: 04.02.2018
 * Time: 15:45
 */
$this->pageTitle = Yii::app()->name . 'Просмотр записи';
$this->breadcrumbs = array('Просмотр записи');
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'view_record',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
));
?>

    <div class="block-header">
        <h1> Просмотр записи </h1>
    </div>
    <div class="block-content">
        <div class="list">
            <div class="row">
                <div class="item-title">
                    <?php echo '<h3>' . $record->title . '</h3>'?>
                </div>
            </div>
            <div class="row">
                <div class="item-input description div">
                    <?php
                    $text = str_replace("\r\n",'<br>', $record->text);
                    echo $text;?>
                </div>
            </div>
        </div>
    </div>
    <div class="block-footer"> </div>

<?php
$this->endWidget();
?>