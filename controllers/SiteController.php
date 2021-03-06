<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MailerForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionMailer()
    {
      //  получается отправить изображения? только если оно имееться в папке


        $model = new MailerForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->passportFace = UploadedFile::getInstance($model, 'passportFace');
            $model->passportMade = UploadedFile::getInstance($model, 'passportMade');
            $model->passportRegistration = UploadedFile::getInstance($model, 'passportRegistration');
            $model->idСodeFace = UploadedFile::getInstance($model, 'idСodeFace');
            $model->interPassportFace = UploadedFile::getInstance($model, 'interPassportFace');
            $model->propertyRightsOne = UploadedFile::getInstance($model, 'propertyRightsOne');
            $model->propertyRightsTwo = UploadedFile::getInstance($model, 'propertyRightsTwo');
            $model->techPassport1 = UploadedFile::getInstance($model, 'techPassport1');
            $model->techPassport2 = UploadedFile::getInstance($model, 'techPassport2');
            $model->techPassport3 = UploadedFile::getInstance($model, 'techPassport3');
            $model->techPassport4 = UploadedFile::getInstance($model, 'techPassport4');
            $model->techPassport5 = UploadedFile::getInstance($model, 'techPassport5');

            $model->uploadAndSend();
            Yii::$app->session->setFlash('mailerFormSubmitted');
            return $this->render('mailer');
        }
        return $this->render('mailer', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}


