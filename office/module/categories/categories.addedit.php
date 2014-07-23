<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushSelect('กลุ่มสินค้า', 'type_code', 'mydata');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('ชื่อประเภท', 'name', 'mydata', '100');
?>   
    </div>
  </div>
</div>