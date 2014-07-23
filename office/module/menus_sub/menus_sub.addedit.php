<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('รหัส', 'id', 'mydata empty', '100');
PushText('ชื่อเมนู', 'name', 'mydata empty', '100');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushSelect('เมนูหลัก', 'menu_code', 'mydata');
PushText('ลำดับ', 'sort', 'mydata', '10');
PushRadio('เปิดใช้งาน', 'enable', 'mydata', array('Y'=>'เปิดการใช้งาน', 'N'=>'ปิดการใช้งาน'));
?>   
    </div>
  </div>
</div>