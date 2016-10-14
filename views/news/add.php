<script type="text/javascript" src="/3rd/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/3rd/swfupload/handlers.js"></script>
<link href="/3rd/swfupload/swfupload.css" rel="stylesheet" type="text/css" />
<style>
.edui-default .edui-editor,.edui-default .edui-editor-toolbarboxouter{border-radius:0;}
</style>

<script type="text/javascript"  src="/js/gaga.js"></script>





<ol class="breadcrumb">
  <li><a href="index.php?r=site/index">首页</a></li>
  <li><a href="index.php?r=news/index">友商管理</a></li>
  <li class="active">新增友商</li>
</ol>



<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">新增友商</div>




        <table class="table">
                <tr>
                <td>友商手机号</td>

                  <td> <input type="text" name="title" id="mobile" ></td>
                </tr>

                <tr>
                <td>昵称</td>

                  <td> <input type="text" name="title" id="nickname" ></td>
                </tr>
                
                <tr>
                <td>密码</td>
                  <td> <input type="text" name="title" id="password" ></td>
                </tr>

        </table>


         <div>

                <button class="btn btn-primary" onclick="save()"  > 保存</button>
        </div>

</div>

<script type="text/javascript">


var save = function() {

  var mobile = document.getElementById("mobile").value;
  var nickname = document.getElementById("nickname").value;
  var password = document.getElementById("password").value;
  $.ajax({
      dataType: "json",
       data:{
              "mobile":mobile,
              "nickname":nickname,
              "password":password
      },
      type: "POST",
      url: "/index.php?r=news/save_seller",
      success: function() {
            alert('success');
      }
  });

};



</script>

