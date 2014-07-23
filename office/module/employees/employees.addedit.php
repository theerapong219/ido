<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('รหัสพนักงาน', 'id', 'mydata empty', '100');
PushSelect('คำนำหน้า', 'prefix', 'mydata', array('MR'=>'นาย', 'MRS'=>'นาง', 'MISS'=>'นางสาว'));
PushText('ชื่อ', 'name', 'mydata empty', '100');
PushText('นามสกุล', 'surname', 'mydata empty', '100');
PushText('ชื่อเล่น', 'nickname', 'mydata', '100');
PushSelect('ระดับ', 'level', 'mydata empty', array('1'=>'พนักงาน', '2'=>'ผู้ใช้งาน', '3'=>'ผู้ดูแลระบบ', '4'=>'ผู้ดูแลสูงสุด'));
PushText('เบอร์โทร', 'tel', 'mydata', '30');
PushText('เบอร์มือถือ', 'mobile', 'mydata empty', '30');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushTextArea('ที่อยู่', 'address', 'mydata');
PushSelect('จังหวัด', 'province_code', 'mydata');
PushText('รหัสไปรษณีย์', 'zipcode', 'mydata', '5');
PushText('อีเมล์', 'email', 'mydata', '100');
PushText('ชื่อผู้ใช้', 'user_name', 'mydata', '100');
PushText('รหัสผ่าน', 'user_pass', 'mydata', '100');
PushCheckbox('เปลี่ยนรหัสผ่าน', 'change_pass', 'mydata');
PushRadio('เปิดใช้งาน', 'enable', 'mydata', array('Y'=>'เปิดการใช้งาน', 'N'=>'ปิดการใช้งาน'));
PushHidden('filepic', 'mydata');
?>    
    </div>
  </div>
</div>
<br/>
<br/>

<h4 class="page-header"><i class="fa fa-picture-o"></i> รูปภาพ</h4>
<div class="row">
  <div id="lyImageAdd" class="col-md-3">
    <div class="panel" style="background-color:#F7FAFC; border-style:dashed;">
      <div class="panel-body" style="margin-top:0; padding:95px 0 91px 0; text-align:center;">
        <button type="button" class="btn btn-primary btn-lg" onclick="me.OpenUpload();"><i class="fa fa-plus"></i> Add picture</button>
      </div>
    </div>
  </div>  
  
  <span id="lyImage" class="gallery" style="display:none;"></span>
  
  <div class="col-md-12" role="form" style="display:none;">
    <div align="right">
      <button type="button" class="btn btn-primary" onclick="me.OpenUpload();"><i class="fa fa-plus"></i> Add picture</button>
    </div>
    <br/>
  </div>
</div>

<div class="modal fade" id="boxImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="ShowImageTitle"></h4>
      </div>
      <div class="modal-body" id="ShowImage" style="background:url(../images/loading.gif) 50% 50% no-repeat;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="boxUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Upload</h4>
      </div>
      <div class="modal-body" id="">
        <div id="uploader"></div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>