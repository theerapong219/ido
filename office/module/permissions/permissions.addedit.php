<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('ชื่อ', 'name', 'mydata', '100');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('รหัสเมนู', 'menu_id', 'mydata', '100');
PushSelect('ประเภทสิทธิ์', 'pertype', 'mydata', array('VIEW'=>'ดูเนื้อหา', 'ADD'=>'เพิ่ม', 'EDIT'=>'แก้ไข', 'DEL'=>'ลบ'));
?>   
    </div>
  </div>
</div>