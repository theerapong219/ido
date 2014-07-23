<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('Company Name (EN)', 'customer_en', 'mydata', '100');
PushText('Contact Name (EN)', 'contact_en', 'mydata', '100');
PushText('Position Name (EN)', 'position_en', 'mydata', '100');
PushTextArea('Address (EN)', 'address_en', 'mydata');
PushText('Site (EN)', 'site_en', 'mydata', '100');
PushText('Tel.', 'tel', 'mydata', '30', '00-000-0000');
PushText('Mobile', 'mobile', 'mydata', '30', '000-000-0000', '999-999-9999');
PushText('Fax', 'fax', 'mydata', '30', '00-000-0000');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText('Company Name (TH)', 'customer_th', 'mydata', '100');
PushText('Contact Name (TH)', 'contact_th', 'mydata', '100');
PushText('Position Name (TH)', 'position_th', 'mydata', '100');
PushTextArea('Address (TH)', 'address_th', 'mydata');
PushText('Site (TH)', 'site_th', 'mydata', '100');
PushText('Website', 'website', 'mydata', '100');
PushText('Employee No.', 'employee_no', 'mydata num', '10', '0');
?>      
    </div>
  </div>
</div>
