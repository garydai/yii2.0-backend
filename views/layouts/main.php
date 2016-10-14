<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="language" content="en" />
  <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
  <link href="/3rd/bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
  <!--link href="/bootstrap-3.2.0-dist/css/bootstrap-theme.min.css" rel="stylesheet"-->
  <link href="/css/gaga.css" rel="stylesheet">
  <script src="/3rd/bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/3rd/silviomoreto-bootstrap-select-83d5a1b/js/bootstrap-select.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" media="screen"  href="/3rd/bootstrap-datepicker-master/css/datepicker3.css">
  <script type="text/javascript"  src="/3rd/bootstrap-datepicker-master/js/bootstrap-datepicker.js"></script>
  <link href="/3rd/summernote/summernote.css" rel="stylesheet">
  <script src="/3rd/summernote/summernote.min.js"></script>
  <link href="/3rd/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <script type="text/javascript"  src="/3rd/jquery.bootgrid/jquery.bootgrid.min.js"></script>
  <link href="/3rd/jquery.bootgrid/jquery.bootgrid.css" rel="stylesheet">

  <title></title>
  


       <style type="text/css">
            body {
  padding-top: 51px;  
}
.text-center {
  padding-top: 20px;
}
.col-xs-12 {
  background-color: #fff;
}
#sidebar {
  height: 100%;
  padding-right: 0;
  padding-top: 20px;
}
#sidebar .nav {
  width: 95%;
}
#sidebar li {
  border:0 #f2f2f2 solid;
  border-bottom-width:1px;
}


.nav > .active > a,
.nav > .active > a:hover,
.nav > .active > a:focus {
  color: #fff;
  background-color: #428bca;
}


/* collapsed sidebar styles */
@media screen and (max-width: 767px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }
  .row-offcanvas-right
  .sidebar-offcanvas {
    right: -41.6%;
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -41.6%;
  }
  .row-offcanvas-right.active {
    right: 41.6%;
  }
  .row-offcanvas-left.active {
    left: 41.6%;
  }
  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 41.6%;
  }
  #sidebar {
    padding-top:0;
  }


}


        </style>

</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="/index.php?r=site/index">后台管理系统</a>
    </div>

    <div class="nav navbar-nav navbar-right">
     <li><a href="/index.php?r=site/out">登出</a></li>
    </div>

  </div>
</nav>

<!--
<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>

-->

<div class="container-fluid">

    <?php if (!\Yii::$app->user->isGuest) {?>
      <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebar" role="navigation">
          <ul class="nav" >
            <li class="active"><a href="/index.php?r=site/index">首页</a></li>
            <li><a href="/index.php?r=orderlist/index">任务管理</a></li>
            <li><a href="/index.php?r=users/index">用户管理</a></li>
            <li><a href="/index.php?r=news/index">友商管理</a></li>
            <li><a href="/index.php?r=tags/index">标签管理</a></li>
            <li><a href="/index.php?r=idverification/index">身份认证管理</a></li>
            <li><a href="/index.php?r=feedback/index">帮助与反馈管理</a></li>
            <li><a href="/index.php?r=orderreport/index">任务举报</a></li>
            <li><a href="/index.php?r=userreport/index">用户举报</a></li>
             <li><a href="/index.php?r=withdraw/index">提现申请</a></li>
          </ul>
      </div>
        <?php }?>


 <div class="col-xs-12 col-sm-10">
  
        <?php echo $content; ?>

</div>

<script type="text/javascript">
$(function(){


  $(".nav").find("li").each(function()
  {

    var a = $(this).find("a:first")[0];
    //alert($(a).attr("href"));
    //alert(location.pathname);


    if ($(a).attr("href") === location.pathname)
    {
      
      $(this).addClass("active");
    }
    else
    {
      $(this).removeClass("active");
    }


                if(location.pathname === "/book/undeal" || location.pathname === "/book/all")
                {
                        $(".dropdown").addClass("active");
                }

                if(location.pathname === "/area/index" || location.pathname === "/area/second")
                {
                        $(".areadown").addClass("active");
                }


  });
})
</script>


</div>  

<!--
  <div id="footer">

    Copyright &copy; --><!--?php echo date('Y'); ?--><!-- by My Company.<br/>
    All Rights Reserved.<br/>-->
    <!--?php echo Yii::powered(); ?-->
  </div><!-- footer -->

</div><!-- page -->

</body>
</html>

<?php $this->endPage() ?>
