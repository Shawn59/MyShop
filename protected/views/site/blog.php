<?php

/**
 * Created by PhpStorm.
 * User: Shawn59
 * Date: 22.01.2018
 * Time: 20:03
 */

$this->pageTitle = Yii::app()->name . 'Создание блога';
?>


<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'blogForm-from',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
        <div class="list">
            <?php if (isset($blog)) {
            $this->breadcrumbs = array('Мой блог');
            $user = Users::model()->findByPk($blog->user_id);
                ?>
            <div class="row">
                <div class="title">
                    <h2>
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            echo "Добро пожаловать на блог пользователя : " . $user->login;
                        } else {
                            echo "Добро пожаловать";
                        }
                        ?>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="title">
                    <h4>Статус</h4>
                </div>
            </div>
            <div class="row">
                <div class="description">
                    <?php echo $form->textArea($blog, 'title', array('maxlength' => 255, 'readonly' => true, 'id' => 'blogTitle'));
                    if ($user->id == Yii::app()->user->id) {
                        echo CHtml::button('Редактирвоать', array(
                            'onClick' => 'editTitle()', 'type' => 'image', 'src' => '/images/2.png', 'id' => 'buttonEditTitle'));
                    }
                    ?>
                </div>
            </div>
        </div>
            <div class="list">
                <div class="row borders">
                    <div class="item">
                        <h4>Записи</h4>
                    </div>
                </div>
                <?php if ($records) {
                    foreach ($records as $record) {
                    ?>
                <div class="row borders">
                    <div class="record">
                        <div class="item">
                            <?php
                                echo CHtml::link($record->title, '/site/record?id=' . $record->id);
                        if ($user->id == Yii::app()->user->id) {
                            echo CHtml::button('Редактирвоать', array(
                                'onClick' => 'editRecord(' . $record->id . ')', 'type' => 'image', 'src' =>'/images/2.png', 'class' => 'buttonEdit'));
                            echo CHtml::button('Удалить', array(
                                'onClick' => 'deleteRecord(' . $record->id . ')', 'type' => 'image', 'class' => 'buttonDel', 'src' =>'/images/1.png'));
                        }
                                ?>
                        </div>
                    </div>
                </div>
                <?php }}?>

        <?php } else { ?>
                <h4>Список блогеров</h4>
            <?php
                //выводим блоги
                foreach ($blogs as $blog) {
                    $userBlog = Users::model()->findByPk($blog->user_id);
                    ?>
                    <div class="list">
                        <div class="row borders">
                            <div class="item">
                                <?php echo CHtml::link($userBlog->login, '/site/blog?id=' . $blog->id);?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            $this->widget('CLinkPager', array(
                'internalPageCssClass' => '',
                'pages' => $pages, //$paginator определен в контроллере
                'id' => '',
                'header' => '',
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled',
                'nextPageLabel' => '&raquo;',         // »
                'prevPageLabel' => '&laquo;',         // «
                'lastPageLabel' => '&raquo;&raquo;',  // »»
                'firstPageLabel' => '&laquo;&laquo;', // ««
                'htmlOptions' => array('class' => 'pagination'),
            ));
        }?>

<?php $this->endWidget(); ?>
                <!--рисуем переключатель страниц-->
               <!-- --><?php /*$this->widget('zii.widgets.CLinkPager', array(
                    'pages' => $pages,
                    'prevPageLabel' => '&laquo; назад',
                    'nextPageLabel' => 'далее &raquo;',
                ));
                */?>
<script>

  var deleteRecord = function (id) {
        $.ajax({
            url: "<?php echo CController::createUrl('site/deleteRecord')?>",
            method: 'Post',
            dataType: 'json',
            data: {
                id: id
            }
        });
    };

  var editRecord = function (id) {
      event.preventDefault();
      document.location.href = "<?php echo CController::createUrl('site/editRecord?id=')?>" + id;
  };
  var editTitle = function () {
      event.preventDefault();
      var title = document.getElementById('blogTitle');
      if ($(title).prop("readonly")) {
          $(title).prop("readonly", false);
      } else {
          $(title).prop("readonly", true);
          $.ajax({
              url: "<?php echo CController::createUrl('site/editBlog')?>",
              method: 'Post',
              dataType: 'json',
              data: {
                  title: title.value
              }
          });
      }
  }
</script>