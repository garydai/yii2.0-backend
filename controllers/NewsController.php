<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\News;

class NewsController extends Controller
{
    public $enableCsrfValidation = false;
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
        $news = News::find()->all();  
        return $this->render('index', ["news"=>$news]);
    }

    public function actionAdd()
    {

      //  $area = Area::model()->findAll();
       return  $this->render('add');

    }

    public function actionGet_data()
    {
    //      var_dump($_POST);
            $count = News::find()->count();
            
            $connection=Yii::$app->db;
            $sql = "select * from news ";
            $condition = '';
            if($_POST['searchPhrase'] !='')
            {
                    $condition.='where title like '.'"%'.$_POST['searchPhrase'].'%" ';
            }
            if(isset($_POST['sort']['title'] ))
            {

                    $condition .= " order by title  {$_POST['sort']['title']} ";
            }
            
            $t = (intval($_POST['current']) -1)*$_POST['rowCount'];
            $condition .= " limit {$t} , {$_POST["rowCount"]}";
            $sql .= $condition;
           # $criteria->limit = $_POST['rowCount'];
           # $criteria->offset= (intval($_POST['current']) -1)*$_POST['rowCount'];
          //  echo $sql;
            #$model = News::find()->all($criteria);
    //      var_dump($model);
            $model = $connection->createCommand( $sql)->queryAll();
            $arr = array();
            foreach($model as $o)
            {
                    $json = array('id'=>intval($o['id']), 'title'=>$o['title']);
                    array_push($arr, $json);

            }
          //var_dump( $arr);        
            echo json_encode(array('rowCount'=>$_POST['rowCount'], 'current'=>$_POST['current'], 'rows'=>$arr, 'total'=>$count));

    }
    public function actionSave_news()
    {
//                if(Yii::app()->request->isAjaxRequest)
            {


                    $news = new News();
                    $news->title = $_POST['title'];
                    $news->content = $_POST['content'];
                    $news->createTime = date('Y-m-d H:i:s');
                    $news->tag = 'unnecessary';
                    $news->save();

                    echo 1;
            }

    }



}
