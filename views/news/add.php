<script type="text/javascript" src="/3rd/swfupload/swfupload.js"></script>
<script type="text/javascript" src="/3rd/swfupload/handlers.js"></script>
<link href="/3rd/swfupload/swfupload.css" rel="stylesheet" type="text/css" />
<style>
.edui-default .edui-editor,.edui-default .edui-editor-toolbarboxouter{border-radius:0;}
</style>

<script type="text/javascript"  src="/js/gaga.js"></script>





<ol class="breadcrumb">
  <li><a href="index.php?r=site/index">首页</a></li>
  <li><a href="index.php?r=news/index">新闻管理</a></li>
  <li class="active">新增新闻</li>
</ol>



<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">新增新闻</div>




        <table class="table">
                <tr>
                <td>新闻标题</td>

                        <td> <input type="text" name="title" id="title" ></td>
                </tr>



                <tr>

                    <td>新闻内容</td>

                        <td>

                        <div class="summernote" id="summernote"></div>

                        </td>

                </tr>
        </table>


         <div>

                <button class="btn btn-primary" onclick="save()"  > 保存</button>
        </div>

</div>

<script type="text/javascript">

$(document).ready(function() {



  $('#summernote').summernote({
          height: 400,                 // set editor height
          onImageUpload: function(files, editor, welEditable)
          {
          //  window.alert(files[0]);
            sendFile(files[0], editor, welEditable);
          }
  });
//  $('.summernote').destroy();
});

  function sendFile(file, editor, welEditable) {
    data = new FormData();
    data.append("file", file);
   // window.alert(data);
    $.ajax({
        data: data,
        type: "POST",
        url: "/index.php?r=news/upload_image",
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
             // alert(url);
            editor.insertImage(welEditable, url);
        }
    });
  }

var save = function() {
  var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
	var source = '';
	var thumb = '';
  var title = document.getElementById("title").value;
  $.ajax({
      dataType: "json",
       data:{
              "title":title,
              "content":aHTML,
      },
      type: "POST",
      url: "/index.php?r=news/save_news",
      success: function() {
            alert('success');
      }
  });

};



</script>

