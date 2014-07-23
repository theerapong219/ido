<ul class="nav nav-tabs">
  <li class="active"><a href="#info" data-toggle="tab">ข้อมูลทั่วไป</a></li>
  <li><a href="#customer" data-toggle="tab">ข้อมูลลูกค้า</a></li>
  <li><a href="#check" data-toggle="tab">ข้อมูลการตรวจ</a></li>
  <li><a href="#plan" data-toggle="tab">แผนนัดตรวจ</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="info">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushTextSelect('Quotation No.', 'quat_id', '', '10');
    PushText('Issue date', 'date_start', 'readonly', '10');
    PushText('Due date', 'date_stop', 'readonly', '10');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Shame Number', 'id', 'readonly', '30');
    PushTextArea('Scope (EN)', 'scope_th', 'readonly');
    PushTextArea('Scope (TH)', 'scope_th', 'readonly');
    ?>   
        </div>
      </div>
    </div>    
  </div><!-- $info -->
  
  <div class="tab-pane" id="customer">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushHidden('cus_code', '');
    PushText('Company Name (EN)', 'customer_en', 'readonly', '100');
    PushText('Contact Name (EN)', 'contact_en', 'readonly', '100');
    PushText('Position Name (EN)', 'position_en', 'readonly', '100');
    PushTextArea('Address (EN)', 'address_en', 'readonly');
    PushText('Tel.', 'tel', 'readonly', '100');
    PushText('Mobile', 'mobile', 'readonly', '100');
    PushText('Fax', 'fax', 'readonly', '100');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Company Name (TH)', 'customer_th', 'readonly', '100');
    PushText('Contact Name (TH)', 'contact_th', 'readonly', '100');
    PushText('Position Name (TH)', 'position_th', 'readonly', '100');
    PushTextArea('Address (TH)', 'address_th', 'readonly');
    PushText('Site', 'site', 'readonly', '100');
    PushText('Website', 'website', 'readonly', '100');
    PushText('Employee No.', 'employee_no', 'readonly num', '10');
    ?>   
        </div>
      </div>
    </div>    
  </div><!-- $info -->
  
  <div class="tab-pane" id="check">
    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushHidden('frequency', '');
    PushText('Frequency', 'frequency_name', 'readonly');
    PushText('Manday plan state 1', 'manday_plan_state1', 'readonly num', '10');
    PushText('Manday plan state 2', 'manday_plan_state2', 'readonly num', '10');
    PushText('Manday plan Surveil', 'manday_plan_surveil', 'readonly num', '10');
    PushText('Manday plan Recert', 'manday_plan_recert', 'readonly num', '10');
    PushText('MD รวม', 'md', 'readonly num', '10');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushHidden('service_code', '');
    PushText('Service', 'service_name', 'readonly');
    PushText('Manday Actual state 1', 'manday_actual_state1', 'readonly num', '10');
    PushText('Manday Actual state 2', 'manday_actual_state2', 'readonly num', '10');
    PushText('Manday Actual Surveil', 'manday_actual_surveil', 'readonly num', '10');
    PushText('Manday Actual Recert', 'manday_actual_recert', 'readonly num', '10');
    ?>   
        </div>
      </div>
    </div>    
  </div><!-- $info -->
  
  <div class="tab-pane" id="plan" style="position:relative; overflow: hidden;">
    <div id="lyPlan" class="slidelr">
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr bgcolor="#f2f2f2">
          <th width="100" class="center" rowspan="2">&nbsp;</th>
          <th width="100" class="center" rowspan="2">Plan</th>
          <th width="100" class="center" rowspan="2">Actual</th>
          <th class="center" colspan="3">สรุปผลการแก้ไขข้อบกพร่อง</th>
          <th class="center" rowspan="2" width="80">Proposed<br/>Status</th>
          <th class="center" rowspan="2" width="80">Closed<br/>Status</th>
          <th class="center" rowspan="2" width="80">Cert</th>
          <th class="center" rowspan="2">&nbsp;</th>
        </tr>
        <tr bgcolor="#f2f2f2">
          <th width="50" class="center">Mg</th>
          <th width="50" class="center">Mi</th>
          <th width="50" class="center">Obs</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $form[]=array('id'=>'initail1', 'name'=>'Initail 1');
        $form[]=array('id'=>'initail2', 'name'=>'Initail 2');
        $form[]=array('id'=>'surv1', 'name'=>'Surv 1');
        $form[]=array('id'=>'surv2', 'name'=>'Surv 2');
        $form[]=array('id'=>'surv3', 'name'=>'Surv 3');
        $form[]=array('id'=>'surv4', 'name'=>'Surv 4');
        $form[]=array('id'=>'surv5', 'name'=>'Surv 5');
        $form[]=array('id'=>'recert', 'name'=>'Recert');

        $t=101;
        foreach($form as $i => $value){
          $id = $value['id'];
          $name = $value['name'];
          echo '
<tr>
  <td class="center">'.$name.'</td>
  <td><input class="form-control mydata dpk" id="'.$id.'_plan" name="'.$id.'_plan" type="text" placeholder="__/__/____" /></td>
  <td><input class="form-control mydata dpk" id="'.$id.'_actual" name="'.$id.'_actual" type="text" placeholder="__/__/____" /></td>
  <td><input class="form-control mydata center" id="'.$id.'_mg" name="'.$id.'_mg" tabindex="'.$t.'" type="text" placeholder="0" /></td>
  <td><input class="form-control mydata center" id="'.$id.'_mi" name="'.$id.'_mi" tabindex="'.($t+1).'" type="text" placeholder="0" /></td>
  <td><input class="form-control mydata center" id="'.$id.'_obs" name="'.$id.'_obs" tabindex="'.($t+2).'" type="text" placeholder="0" /></td>
  <td class="center">
    <button id="'.$id.'_propose" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>
    <button id="'.$id.'_propose" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
  </td>
  <td class="center">
    <button id="'.$id.'_propose" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>
    <button id="'.$id.'_propose" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
  </td>
  <td class="center">
    <button id="'.$id.'_propose" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>
    <button id="'.$id.'_propose" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
  </td>
  <td class="center">
    <button id="'.$id.'_auditor" onclick="me.OpenAuditor();" class="btn btn-xs btn-link"><i class="fa fa-smile-o"></i> Auditor</button> |
    <button id="'.$id.'_list" onclick="me.OpenList();" class="btn btn-xs btn-link"><i class="fa fa-list-ol"></i> รายการตรวจ</button> |
    <button id="'.$id.'_doc" onclick="me.OpenList();" class="btn btn-xs btn-link"><i class="fa fa-file-o"></i> เอกสาร</button>
  </td>
</tr>  
          ';      
          $t+=3;
        }

        ?>
      </tbody>
    </table>    
    </div>
    
    <div id="lyAuditor" class="slidelr" style="display:none;">
      <h4 class="page-header"><i class="fa fa-list-ul"></i> Auditor <span id="topicAuditor" class="label label-info">Initail 1</span></h4>
      
      <table width="100%">
        <tr>
          <td>
            <button id="" onclick="me.CloseAuditor();" class="btn btn-warning" type="button"><i class="fa fa-mail-reply"></i> Back</button>
          </td>
          <td class="right">
            <button id="" onclick="me.OpenModalAuditor();" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>
          </td>
        </tr>
      </table> 
      <br/>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th width="30" class="center">#</th>
            <th class="center">Auditor</th>
            <th width="100" class="center">หน้าที่</th>
            <th width="120" class="center">Tool</th>
          </tr>
        </thead>
        <tbody id="lyDetail">
        </tbody>
      </table>  
    </div><!-- $auditor -->
    
    <div id="lyList" class="slidelr" style="display:none;">
      <h4 class="page-header"><i class="fa fa-list-ul"></i> รายการตรวจ <span id="topicAuditor" class="label label-warning">Initail 1</span></h4>
      
      <table width="100%">
        <tr>
          <td>
            <button id="" onclick="me.CloseList();" class="btn btn-warning" type="button"><i class="fa fa-mail-reply"></i> Back</button>
          </td>
          <td class="right">
            <button id="" onclick="me.OpenModalList();" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>
          </td>
        </tr>
      </table> 
      <br/>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th width="100" class="center">Auditor</th>
            <th width="80" class="center">Start</th>
            <th width="80" class="center">Stop</th>
            <th class="center">Detail</th>
            <th width="80" class="center">Tool</th>
          </tr>
        </thead>
        <tbody id="lyDetail">
        </tbody>
      </table>  
    </div><!-- $list -->
    
  </div><!-- $info -->
</div>

  
<!-- Modal -->
<div class="modal fade" id="ModalQuat" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Quatation</h4>
      </div>
      <div class="modal-body">
        
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr bgcolor="#f2f2f2">
            <th class="center" width="100">Quot No.</th>
            <th class="center">ลูกค้า</th>
            <th class="center">Service</th>
            <th width="120" class="center">เวลาอนุมัติ</th>
            <th width="90" class="center">&nbsp;</th>
          </tr>
        </thead>
        <tbody id="lyQuat">
          <tr>
            <td class="center">570001</td>
            <td class="center">ไร่ไม่จน</td>
            <td class="center">ISO-9002</td>
            <td class="center">12/12/2014 12:12</td>
            <td class="center"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Select</button></td>
          </tr>
        </tbody>
      </table>  
          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<!-- Modal -->
<div class="modal fade" id="ModalAuditor" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Auditor</h4>
      </div>
      <div class="modal-body">
        

    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushSelect('Auditor', 'auditor', '');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushSelect('Position', 'auditor_position', '');
    ?>   
        </div>
      </div>
    </div>           
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  
<!-- Modal -->
<div class="modal fade" id="ModalList" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">List</h4>
      </div>
      <div class="modal-body">

    <div class="row">
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Start', 'date_start_list', 'dtpk');
    ?>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-horizontal" role="form">
    <?php
    PushText('Stop', 'date_stop_list', 'dtpk');
    ?>   
        </div>
      </div>
    </div>  
        
         <br/>
         
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
          <div id="dvid" class="form-group">
            <label id="lblid" for="id" class="col-sm-2 control-label" style="white-space:nowrap">Auditor :</label>
            <div class="col-sm-10">
              <div class="input-group">
                <select id="auditor" name="auditor" class="form-control select2 ">
                  <option value=""></option>
                    
                </select>
                <span class="input-group-btn"> 
                  <button id="btnid" class="btn btn-info" type="button" style="padding:5px;"><i class="fa fa-plus"></i> Add</button> 
                </span>
              </div>
            </div>
          </div>   
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
          <div id="dvid" class="form-group">
            <label id="lblid" for="id" class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">

  <div class="select2-container select2-container-multi form-control select2" id="s2id_autogen3">
    <ul class="select2-choices">  
      <li class="select2-search-choice">    
        <div>Auditor 1</div>    
        <a href="#" onclick="return false;" class="select2-search-choice-close" tabindex="-1"></a>
      </li>
      <li class="select2-search-choice">
        <div>Auditor 2</div>    
        <a href="#" onclick="return false;" class="select2-search-choice-close" tabindex="-1"></a>
      </li>

    </ul>
  </div>            
            </div>
          </div>   
        </div>
      </div>
    </div> 
        
         <br/>
        
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
          <div id="dvid" class="form-group">
            <label id="lblid" for="id" class="col-sm-2 control-label" style="white-space:nowrap">List :</label>
            <div class="col-sm-10">
              <div class="input-group">
                <select id="auditor" name="auditor" class="form-control select2 ">
                  <option value=""></option>
                    
                </select>
                <span class="input-group-btn"> 
                  <button id="btnid" class="btn btn-info" type="button" style="padding:5px;"><i class="fa fa-plus"></i> Add</button> 
                </span>
              </div>
            </div>
          </div>    
          <div id="dvdetail" class="form-group">
            <div class="col-sm-12">
              <textarea class="mydata" id="detail" name="detail"></textarea>
            </div>
          </div>   
        </div>
      </div>
    </div>    
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

