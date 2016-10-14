<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Order;
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
      //  $news = News::find()->all();  
      //  echo 1123;
        return $this->render('index');
    }

    public function actionSave_seller()
    {
        echo 123;

        $password = sha1($_POST['password']);
        $sql="insert into User set Name = {$_POST['nickname']}, Mobile={$_POST['mobile']}, Password='{$password}'";
        $connection=Yii::$app->db; 

        $command=$connection->createCommand($sql)->execute();
    }

    public function actionAdd()
    {

      //  $area = Area::model()->findAll();
       return  $this->render('add');

    }

    public function actionAdd_service()
    {


      //  $area = Area::model()->findAll();
       return  $this->render('addservice');

    }

    public function actionSave_service()
    {
        //    $sql="insert into `Order` set Title = '{$_POST['title']}', Content='{$_POST['content']}',
         //Bounty='{$_POST['reward']}', Orderer = {$_POST['id']}, Address='{$_POST['location']}',
         // PaymentMethod = '{$_POST['payment']}', Request='{$_POST['require']}, Category='{$_POST['category']}', Recommended=1 ";
                     $sql="insert into `Order` set Title = '{$_POST['title']}', Content='{$_POST['content']}', Bounty='{$_POST['reward']}', Orderer = {$_POST['id']}, Address='{$_POST['location']}', PaymentMethod = '{$_POST['payment']}', Request='{$_POST['require']}', Category={$_POST['category']}";
         

        $connection=Yii::$app->db; 

        $command=$connection->createCommand($sql)->execute();
        echo 1;


    }
    public function actionGet_data()
    {
    //      var_dump($_POST);
            //$count = Order::find()->count();
            
            $sql="select COUNT(*) FROM `Order`";
             $connection=Yii::$app->db; 

             $count=$connection->createCommand($sql)->queryScalar();
           // echo $count;
            $connection=Yii::$app->db;
            $sql = "select * from `Order` ";
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
                    $json = array('id'=>intval($o['Id']), 'title'=>$o['Title']);
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
    public function actionUpload_image()
    {
        
        if ($_FILES['file']['name']) 
        {
//          echo $_FILES['file']['name'];
                if (!$_FILES['file']['error']) 
            {
                    $name = md5(rand(100, 200));
                    $ext = explode('.', $_FILES['file']['name']);
                    $filename = $name . '.' . $ext[1];
                    $destination = 'images/' . $filename; //change this directory
                    $location = $_FILES["file"]["tmp_name"];
//          echo $location;
                    move_uploaded_file($location, $destination);
                    copy($destination, '../../yuleWeb/web/images/'.$filename);
                    echo '/images/' . $filename;//change this URL
                }
                else
                {
                  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
                }
            }
        
    }   



}
