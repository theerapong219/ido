<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushPassword('รหัสผ่านเดิม', 'old_pass', 'mydata empty', '100');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushPassword('รหัสผ่านใหม่', 'new_pass', 'mydata empty', '100');
PushPassword('รหัสผ่านใหม่ อีกครั้ง', 'new_pass_again', 'mydata empty', '100');
?>    
    </div>
  </div>
</div>