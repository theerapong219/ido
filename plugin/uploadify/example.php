<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> Test Uploadify </title>

<link type="text/css" rel="stylesheet" href="uploadify/uploadify.css" />
<script type="text/javascript" language="javascript" src="uploadify/jquery.js"></script>
<script type="text/javascript" language="javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="uploadify/uploadify.js"></script>
<style>
  .upload{}
  .upload .btnupload{margin-top:5px;}
</style>
<script type="text/javascript" language="javascript">
<!--
$(document).ready(function(){
  $('#UploadPic').uploadify({
    'script'        : 'upload.inc.php',
    'uploader'      : 'uploadify/uploadify.swf',
    'cancelImg'     : 'uploadify/cancel.png',
    'folder'        : 'img',
    'buttonText'    : 'Browse...',
    'fileExt'       : '*.jpg;*.gif',
    'fileDesc'      : 'Image Files',
    'queueID'       : 'UploadQueue',
    'auto'          : true,
    'multi'         : true,
    'onSelect'      : function(event,ID,fileObj){
      var myData={};
      myData['Code']='AB00000001';
      $('#UploadPic').uploadifySettings('scriptData', myData);
    },
    'onComplete'  : function(event, queueID, fileObj, response, data){
      var data = $.parseJSON(response);
      switch(data.success){
        case 'COMPLETE' :
          $('#Result').html('<img src="'+data.Path+'" />');
          break;
        default :
          $('#Result').html('ERROR!!!');
          break;
      }
    }
  });
});
//-->
</script>

</head>

<body>
  <h1>Uploadify</h1>
  <div class="upload">
    <input type="hidden" value="" />
    <div id="Result"><img src="img/nopic.jpg" width="300" height="300" /></div>
    <div class="btnupload"><span id="UploadPic"></span></div>
    <div id="UploadQueue" class="queue"></div>
  </div>
</html>