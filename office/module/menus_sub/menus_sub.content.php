<div id="toolview" class="mymenu">
  <?php if($per_add){ ?>
  <button id="btnViewAdd" onclick="me.New();" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> เพิ่ม</button>
  <?php } ?>
  <button id="btnViewReload" onclick="me.ViewList();" class="btn btn-primary" type="button"><i class="fa fa-refresh"></i> โหลดใหม่</button>
</div>
<div id="tooladd" class="mymenu" style="display:none;">
  <button id="btnAddView" onclick="me.ViewList();" class="btn btn-primary" type="button"><i class="fa fa-list-alt"></i> รายการ</button>
  <?php if($per_add){ ?>
  <button id="btnAddSave" onclick="me.Add();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> บันทึก</button>
  <?php } ?>
  <button id="btnAddClear" onclick="me.Clear();" class="btn btn-primary" type="button"><i class="fa fa-file-o"></i> ล้าง</button>
</div>
<div id="tooledit" class="mymenu" style="display:none;">
  <button id="btnEditView" onclick="me.ViewList();" class="btn btn-primary" type="button"><i class="fa fa-list-alt"></i> รายการ</button>
  <?php if($per_edit){ ?>
  <button id="btnEditSave" onclick="me.Edit();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> บันทึก</button>
  <?php }if($per_add){ ?>
  <button id="btnEditAdd" onclick="me.New();" class="btn btn-primary" type="button"><i class="fa fa-plus"></i> เพิ่ม</button>
  <?php } ?>
  <button id="btnEditFirst" onclick="me.First();" class="btn btn-primary" type="button"><i class="fa fa-fast-backward"></i></button>
  <button id="btnEditPrev" onclick="me.Prev();" class="btn btn-primary" type="button"><i class="fa fa-step-backward"></i></button>
  <button id="btnEditNext" onclick="me.Next();" class="btn btn-primary" type="button"><i class="fa fa-step-forward"></i></button>
  <button id="btnEditLast" onclick="me.Last();" class="btn btn-primary" type="button"><i class="fa fa-fast-forward"></i></button>
  <?php if($per_del){ ?>
  <button id="btnEditDel" onclick="me.DelEdit();" class="btn btn-danger" type="button"><i class="fa fa-trash-o"></i> ลบ</button>
  <?php } ?>
</div>

<section class="content">
  <div class="header">
    <div class="col-md-12">
      <h3 class="header-title"><i class="fa <?php echo (empty($_GET['parent']))?$mymenu['icon']:$parentmenu['icon']; ?>"></i> <?php echo $mymenu['name']; ?>
      <?php if(!empty($mainmenu)){echo ' <i class="fa fa-long-arrow-right"></i> '.$mainmenu['name'];} ?>
      </h3>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="main-content">
    <div id="tabviewlist" class="row">
      <div class="col-md-12" id="lyViewList">
        <div id="RowPage" style="float:left; margin:0 0 10px 0;">
          <select id="cboLimit" class="form-control" style="width:150px;">
            <option value="10">แสดง &nbsp;&nbsp;10 รายการ</option>
            <option value="50">แสดง &nbsp;&nbsp;50 รายการ</option>
            <option value="100">แสดง 100 รายการ</option>
          </select>
        </div>
        <ul id="lyPage" class="pagination pagination-sm" style="float:right; margin:0 0 10px 0;">

        </ul>
        <form id="frmSearch" method="post" action=" " onsubmit="return false;">
          <table class="table table-striped table-hover table-bordered">
            <thead id="thView">

            </thead>
            <thead id="thLoading">
            </thead>
            <tbody id="tbView" style="display:none;">
            </tbody>
          </table>
        </form> 
      </div>
    </div> 
    <div id="tabaddedit" class="row" style="display:none;">
      <div class="col-md-12" id="lyAddEdit">
        <?php include "module/$mod/$mod.addedit.php"; ?>

        <div id="lyStatus" align="center" style="margin-top:10px;">
          <table class="table table-bordered">
            <thead>
              <tr >
                <th class="center thmark">รหัส</th>
                <th class="center thmark">สร้างโดย</th>
                <th class="center thmark">แก้ไขโดย</th>
                <th class="center thmark">วันสร้าง</th>
                <th class="center thmark">วันแก้ไข</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input id="code" type="text" class="txtstatus" disabled="disabled" /></td>
                <td><input id="user_create" type="text" class="txtstatus" disabled="disabled" /></td>
                <td><input id="user_update" type="text" class="txtstatus" disabled="disabled" /></td>
                <td><input id="date_create" type="text" class="txtstatus datetime" disabled="disabled" /></td>
                <td><input id="date_update" type="text" class="txtstatus datetime" disabled="disabled" /></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div> 
  </div>
  <!-- END: CONTENT -->
</section>

<input type="hidden" id="sortby" value="code" />
<input type="hidden" id="sortorder" value="asc" />
<input type="hidden" id="firstcode" value="" />
<input type="hidden" id="prevcode" value="" />
<input type="hidden" id="nextcode" value="" />
<input type="hidden" id="lastcode" value="" />