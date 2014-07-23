<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('ID', 'id', 'mydata', '30');
PushText('Audit Name (EN)', 'name_en', 'mydata', '100');
PushTextArea('Address (EN)', 'address_en', 'mydata');
PushText('Tel.', 'tel', 'mydata', '30', '00-000-0000');
PushText('Mobile', 'mobile', 'mydata', '30', '000-000-0000');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('Audit Name (TH)', 'name_th', 'mydata', '100');
PushTextArea('Address (TH)', 'address_th', 'mydata');
PushText('Fax', 'fax', 'mydata', '30');
PushText('Website', 'website', 'mydata', '200');
?>   
    </div>
  </div>
</div>