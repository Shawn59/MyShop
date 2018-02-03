<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                /*'fixedVerifyCode' => "111",*/
                'backColor' => 0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                /*'testLimit' => 1,*/ // обновляем капчу после первой неудачной попытки
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('blog');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionRegister()
    {
        $user = new Users();
        $user->scenario = 'registerCaptcha';
        if (isset($_POST['Users'])) {
            $user->attributes = $_POST['Users'];
            $user->role_id = 2;
            if ($user->validate() && $user->save()) {
                Yii::app()->user->setFlash('reg', 'Вы успешно зарегистрировались');
                $this->refresh();
            }
        }
        $this->render('register', array('model' => $user));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $auth = new authorizationForm;
        // collect user input data
        if (isset($_POST['authorizationForm'])) {
            $auth->attributes = $_POST['authorizationForm'];
            // validate user input and redirect to the previous page if valid
            if ($auth->validate() && $auth->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('login', array('model' => $auth));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public  function  actionBlog() {
        $blog = Blogs::model()->find('user_id = :Uid', array(':Uid' => Yii::app()->user->id));
            $records = Records::model()->findAll('blog_id = :Bid', array(':Bid' => $blog->id));
            $comment = new Comments();
            $this->render('blog', array('blog' => $blog, 'records' => $records, 'comment' => $comment));
    }

    public function actionEditRecord() {
        $record = new Records();
        $this->render('editRecord', array('record' => $record));
    }

    public function addComment() {
        $f = $_POST;
    }
}