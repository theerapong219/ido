<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />

    <title>-</title>
  <link type="text/css" rel="stylesheet" href="../plugin/uploadify/uploadify.css" />


  </head>

  <body>
    <table width="100%" cellpadding="3" cellspacing="0" border="0" id="addedit-data-2">
      <tr>
        <td valign="top" align="left">&nbsp;</td>
        <td align="left"><a href="export.php">Export</a></td>
      </tr>   
      <tr>
        <td width="200">&nbsp;</td>
        <td align="left" valign="top">
          <div id="excelimage"></div>
          <div id="excelqueue" class="queue"></div>
          <input type="hidden" id="excel" name="excel" class="excel" value="" />
        </td>
      </tr>
      <tr>
        <td valign="top" align="left"><label class="lbl">ไฟล์ excel :</label></td>
        <td align="left">
          <span id="ExcelUpload"></span>
        </td>
      </tr>      
    </table>
    <table width="100%" cellpadding="3" cellspacing="0" border="1" id="lyExcel" style="border-collapse:collapse;">  

    </table>

  </body>
  <script src="../jquery/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="../plugin/uploadify/swfobject.js"></script>
  <script type="text/javascript" language="javascript" src="../plugin/uploadify/uploadify.js"></script>
<script>
var ae = {};

ae.CreateUploadExcel=function(){
	$('#ExcelUpload').uploadify({
    'script'        : 'upload.php',
    'uploader'      : '../plugin/uploadify/uploadify.swf',
    'cancelImg'     : '../plugin/uploadify/cancel.png',
    'folder'        : '../xls',
    'buttonText'    : 'Browse...',
    'fileExt'       : '*.xls',
    'fileDesc'      : 'Excel Files',
    'queueID'       : 'ExcelQueue',
    'auto'          : true,
    'multi'         : false,
    'onSelect'      : function(event,ID,fileObj){
      var myData={};
      $('#ExcelUpload').uploadifySettings('scriptData', myData);
    },
    'onComplete'  : function(event, queueID, fileObj, response, data){
//			alert(response); return;
      var data = $.parseJSON(response);
      switch(data.success){
        case 'COMPLETE' :
					ae.AppendExcel(data);
          break;
        default :
          alert('upload error!!');
          break;
      }
    }
  });
};

ae.AppendExcel=function(data){
	$('#lyExcel tr').remove();
	
	var html = '';
	html += '<tr bgcolor="#cccccc">';
	$.each(data.topic, function(i, field){
		html += '<th align="center"><label>'+field+'</label></th>';
	});
	html += '</tr>';
	
	$('#lyExcel').append(html);
	
	$.each(data.record, function(i, row){
		html = '<tr bgcolor="#ffffff" class="xlsrow">';
		$.each(row, function(j, field){
			html += '<td align="center" class="xlscol">'+field+'</td>';
		});
		html += '</tr>';
		$('#lyExcel').append(html);
	});	
};

$(document).ready(function(){
  ae.CreateUploadExcel();
}); 
</script>
</html>