<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
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

    public function actionIndex()
    {
        print_r(Yii::$app->coreComponents());die;


        return $this->render('index');
    }

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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionTime(){
        #正向推移
        //创建DateTIME实例
        $datetime = new \DateTime('2018-07-01');

        //创建间隔两天的间隔
        $interval = new \DateInterval('P2W');

        //修改DateTime实例
        $datetime->add($interval);
        echo $datetime->format('Y-m-d H:i:s');


        #反向推移
        $dateStart = new \DateTime();
        $dateInterval = \DateInterval::createFromDateString('-1 day');
        $datePeriod = new \DatePeriod($dateStart,$dateInterval,3);
        foreach ( $datePeriod as $date){
            echo $date->format('Y-m-d'),PHP_EOL;
        }

        #时区
        $timezone = new \DateTimeZone('America/New_York');
        $datetime = new \DateTime('2018-07-26 09:00:00',$timezone);
        print_r( $datetime );
        $datetime->setTimezone(new \DateTimeZone('Asia/Hong_Kong'));    //修改DateTime实例的时区
        print_r( $datetime );
    }

    //实现下载大文件，解决内存溢出
    public function actionExport(){

        $filename =  'sun.csv'; //设置文件名
        header('Content-Type: text/csv');
        header("Content-Disposition: attachment;filename={$filename}");

        $fp = fopen('php://output', 'w');

        $sql = 'select * from "SCM_tbIOStockDtl"';

        //非迭代器实现  十万多条数据，导出csv服务器直接崩溃,内存溢出
//        $list = Yii::$app->db->createCommand($sql)->queryAll();

        //PDO::query() 本身由迭代器实现
        $pdo = new \PDO('pgsql:host=192.168.33.30;port=5432;dbname=jump', 'postgres', '123456');
        $pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        $list = $pdo->query($sql);

        foreach ( $list  as  $fields ) {
            fputcsv ( $fp ,  $fields );
        }

        fclose ( $fp );
    }

    //读取大文件
    public function actionRead(){

        $result = $this->readCsv(Yii::$app->basePath.'/web/file/sun.csv');

        foreach ($result as $v){
            echo "<pre>";
            var_dump( $v);
            echo "</pre>";
        }

    }

    #生成器
    function readCsv( $file ){

        $fp = fopen($file,'rb');

        while( !feof($fp) ){
            yield fgetcsv($fp);
        }

        fclose($fp);
    }
}
