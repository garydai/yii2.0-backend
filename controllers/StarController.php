<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Stars;
class StarController extends Controller
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

    public function actionArchives()
    {
        
        $connection=Yii::$app->db;
        $sql = "select * from stars left join images on stars.avatar = images.id ORDER BY CONVERT( name USING gbk ) COLLATE gbk_chinese_ci ASC ";
        $stars = $connection->createCommand( $sql)->queryAll();
        
        return $this->render('archives', ['stars'=>$stars]);
    }

    public function actionAlbums()
    {
        $connection=Yii::$app->db;
        $sql = "select * from stars ORDER BY CONVERT( name USING gbk ) COLLATE gbk_chinese_ci ASC ";
        $stars = $connection->createCommand( $sql)->queryAll();
        foreach ($stars as &$star) {
            $sql = "select * from images where id in  ({$star['album']}) ";
            $images = $connection->createCommand( $sql)->queryAll();
            $star['albumUrl'] = $images;
            $sql = "select * from images where id =  {$star['avatar']} ";
            $images = $connection->createCommand( $sql)->queryAll();
            $star['avatarUrl'] = $images[0];
            //array_push($star, )
           //var_dump( $star['albumUrl']);
        }
      //  var_dump($stars);
        return $this->render('albums',  ['stars' => $stars]);
    }

}
