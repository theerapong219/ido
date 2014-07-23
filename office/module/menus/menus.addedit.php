<h4 class="page-header"><i class="fa fa-list-ul"></i> Menu</h4>
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
PushText('ลำดับ', 'sort', 'mydata num', '10', '0');
PushTextSelect('Icon', 'icon', 'mydata'); 
PushRadio('เปิดใช้งาน', 'enable', 'mydata', array('Y'=>'เปิดการใช้งาน', 'N'=>'ปิดการใช้งาน'));
?>   
    </div>
  </div>
</div>

<br/>

<h4 class="page-header"><i class="fa fa-list-ul"></i> Sub menu</h4>
<div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
    <table width="100%">
      <tr>
        <td>&nbsp;</td>
        <td class="right">
          <button id="" onclick="me.OpenModalSubmenu();" class="btn btn-success" type="button"><i class="fa fa-plus"></i> Add</button>
        </td>
      </tr>
    </table> 
    <br/>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr bgcolor="#f2f2f2">
          <th width="80" class="center">#</th>
          <th class="center">รหัส</th>
          <th class="center">ชื่อเมนู</th>
          <th width="100" class="center">ลำดับ</th>
          <th width="80" class="center">ใช้งาน</th>
          <th width="140">&nbsp;</th>
        </tr>
      </thead>
      <tbody id="lySubmenu">
      </tbody>
    </table>  
        </div>
        </div>
</div>

<div class="modal fade" id="ModalIcon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:95%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Icon</h4>
      </div>
      <div class="modal-body" id="menuIcon">
        <?php include 'menus.icon.php'; ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalSubmenu" tabindex="-1" role="dialog" aria-labelledby="List" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Sub menu <span id="subeditid"></span></h4>
      </div>
      <div class="modal-body">
        
    <div class="row">
      <div class="col-md-12">
        <div class="form-horizontal" role="form">
    <?php
PushHidden('sub_code', '');
PushText('รหัส', 'sub_id', '', '100');
PushText('ชื่อเมนู', 'sub_name', '', '100');
PushText('ลำดับ', 'sub_sort', 'num', '10', '0');
PushRadio('เปิดใช้งาน', 'sub_enable', '', array('Y'=>'เปิดการใช้งาน', 'N'=>'ปิดการใช้งาน'));
    ?>
        </div>
      </div>
    </div>         
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" id="btnAddSubmenu" onclick="me.AddSubmenu();" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
        <button type="button" id="btnEditSubmenu" style="display:none;" onclick="me.EditSubmenu();" class="btn btn-primary"><i class="fa fa-check"></i> OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->