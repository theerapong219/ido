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
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('เบอร์โทร', 'tel', 'mydata', '30');
PushText('เบอร์มือถือ', 'mobile', 'mydata empty', '30');
PushTextArea('ที่อยู่', 'address', 'mydata');
PushSelect('จังหวัด', 'province_code', 'mydata');
PushText('รหัสไปรษณีย์', 'zipcode', 'mydata', '5');
PushText('อีเมล์', 'email', 'mydata', '100');
?>    
    </div>
  </div>
</div>