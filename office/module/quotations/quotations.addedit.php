<div class="alert alert-success" id="lyApprove">
  <?php if($per_edit){ ?>
  <button type="button" onclick="me.CancelEdit();" class="btn btn-default btn-xs" style="float:right;"><i class="fa fa-rotate-left"></i> Cancel</button>
  <?php } ?>
  <i class="fa fa-check-circle"></i>
  <strong>Approved</strong> รายการนี้ถูกอนุมัติโดย คุณ<span id="user_approve"></span> เวลา <span id="date_approve"></span>
</div>
<div class="alert alert-danger" id="lyReject">
  <?php if($per_edit){ ?>
  <button type="button" onclick="me.CancelEdit();" class="btn btn-default btn-xs" style="float:right;"><i class="fa fa-rotate-left"></i> Cancel</button>
  <?php } ?>
  <i class="fa fa-times"></i>
  <strong>Reject</strong> รายการไม่ถูกอนุมัติโดย คุณ<span id="user_reject"></span> เวลา <span id="date_reject"></span>
</div>
<div class="alert alert-warning" id="lyWaiting">
  <?php if($per_edit){ ?>
  <button type="button" onclick="me.RejectEdit();" class="btn btn-danger btn-xs" style="float:right;"><i class="fa fa-times"></i> Reject</button>
  <button type="button" onclick="me.ApproveEdit();" class="btn btn-success btn-xs" style="float:right; margin-right:5px;"><i class="fa fa-check"></i> Approve</button>
  <?php } ?>
  <i class="fa fa-question-circle"></i>
  <strong>Waiting...</strong>
</div>

<ul class="nav nav-tabs">
  <li class="active"><a href="#info" data-toggle="tab">ข้อมูลทั่วไป</a></li>
  <li><a href="#customer" data-toggle="tab">ข้อมูลลูกค้า</a></li>
  <li><a href="#check" data-toggle="tab">ข้อมูลการตรวจ</a></li>
  <li><a href="#standard" data-toggle="tab">มาตรฐาน</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="info">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Quotation No.', 'id', 'readonly', '10');
    PushText('Issue date', 'date_start', 'mydata dpk', '10');
    PushText('Due date', 'date_stop', 'mydata dpk', '10');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushTextArea('Scope (EN)', 'scope_th', 'mydata');
    PushTextArea('Scope (TH)', 'scope_th', 'mydata');
    ?>   
        </div>
      </div>
    </div>    
  </div><!-- $info -->
  
  <div class="tab-pane" id="customer">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
          <div id="dvcus_code" class="form-group">
            <label id="lblcus_code" for="cus_code" class="col-sm-4 control-label" style="white-space:nowrap">Client :</label>
            <div class="col-sm-8">
              <div class="input-group">
                <select id="cus_code" name="cus_code" class="form-control select2 mydata"></select>
                <span class="input-group-btn"> 
                  <button id="btncus_code" class="btn btn-info" type="button" style="padding:5px;"><i class="fa fa-plus"></i> New</button> 
                </span>
              </div>
              <span id="ecus_code" class="help-block err" style="display:none;">กรุณาเลือก Client</span>
            </div>
          </div>          
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
          <div class="form-group">
            <label class="col-sm-4 control-label">&nbsp;</label>
            <div class="col-sm-8">&nbsp;</div>
          </div> 
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
  </div><!-- $customer -->
  
  <div class="tab-pane" id="check">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushSelect('Frequency', 'frequency', 'mydata', array('6'=>'ทุก 6 เดือน', '12'=>'ทุก 12 เดือน'));
    PushText('Manday plan state 1', 'manday_plan_state1', 'mydata num', '10', '0');
    PushText('Manday plan state 2', 'manday_plan_state2', 'mydata num', '10', '0');
    PushText('Manday plan Surveil', 'manday_plan_surveil', 'mydata num', '10', '0');
    PushText('Manday plan Recert', 'manday_plan_recert', 'mydata num', '10', '0');
    PushText('Manday รวม', 'manday_total', 'mydata num', '10', '0');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushSelect('Service', 'service_code', 'mydata');
    PushText('Manday Actual state 1', 'manday_actual_state1', 'mydata num', '10', '0');
    PushText('Manday Actual state 2', 'manday_actual_state2', 'mydata num', '10', '0');
    PushText('Manday Actual Surveil', 'manday_actual_surveil', 'mydata num', '10', '0');
    PushText('Manday Actual Recert', 'manday_actual_recert', 'mydata num', '10', '0');
    ?>   
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
    <?php
    PushTextEditor('Remark', 'remark', 'mydata');
    ?>
        </div>
      </div>
    </div>    
  </div><!-- $check -->
  
  <div class="tab-pane" id="standard">
    <table width="100%">
      <tr>
        <td>&nbsp;</td>
        <td class="right">
          <button id="" onclick="me.OpenModalStandard();" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>
        </td>
      </tr>
    </table> 
    <br/>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr bgcolor="#f2f2f2">
          <th width="30" class="center">#</th>
          <th class="center">Description</th>
          <th width="100" class="center">Unit/Cost</th>
          <th width="100" class="center">Price</th>
          <th width="120" class="center">Tool</th>
        </tr>
      </thead>
      <tbody id="lyDetail">
      </tbody>
    </table>
    
  </div><!-- $standard -->
</div>

<!-- Modal -->
<div class="modal fade" id="ModalStandard" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">มาตรฐาน</h4>
      </div>
      <div class="modal-body">
        
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Description', 'description', '', '100');
    PushText('Unit/Cost', 'cost', 'num', '10');
    PushText('Price', 'price', 'num', '10');
    PushHidden('desc_code', '', '');
    ?>
        </div>
      </div>
    </div>         
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" id="btnAddDesc" onclick="me.AddDesc();" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
        <button type="button" id="btnEditDesc" style="display:none;" onclick="me.EditDesc();" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="ModalCustomer" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">เพิ่มลูกค้า</h4>
      </div>
      <div class="modal-body">
        
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Company Name (EN)', 'add_customer_en', 'add_data', '100');
    PushText('Contact Name (EN)', 'add_contact_en', 'add_data', '100');
    PushText('Position Name (EN)', 'add_position_en', 'add_data', '100');
    PushTextArea('Address (EN)', 'add_address_en', 'add_data');
    PushText('Site (EN)', 'add_site_en', 'add_data', '100');
    PushText('Tel.', 'add_tel', 'add_data', '30', '00-000-0000');
    PushText('Mobile', 'add_mobile', 'add_data', '30', '000-000-0000', '999-999-9999');
    PushText('Fax', 'add_fax', 'add_data', '30', '00-000-0000');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Company Name (TH)', 'add_customer_th', 'add_data', '100');
    PushText('Contact Name (TH)', 'add_contact_th', 'add_data', '100');
    PushText('Position Name (TH)', 'add_position_th', 'add_data', '100');
    PushTextArea('Address (TH)', 'add_address_th', 'add_data');
    PushText('Site (TH)', 'add_site_th', 'add_data', '100');
    PushText('Website', 'add_website', 'add_data', '100');
    PushText('Employee No.', 'add_employee_no', 'add_data num', '10', '0');
    ?>   
        </div>
      </div>
    </div>   
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" id="btnAddDesc" onclick="me.AddDesc();" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->