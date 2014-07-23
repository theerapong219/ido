<div id="tooledit" class="mymenu">
  <button id="btnEditSave" onclick="me.Edit();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> บันทึก</button>
</div>

<section class="content">
  <div class="header">
    <div class="col-md-12">
      <h3 class="header-title"><i class="fa <?php echo (empty($_GET['parent']))?$mymenu['icon']:$parentmenu['icon']; ?>"></i> <?php echo $mymenu['name']; ?></h3>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="main-content">
    <div id="tabaddedit" class="row">
      <div class="col-md-12" id="lyAddEdit">
        <?php include "module/$mod/$mod.addedit.php"; ?>
      </div>
    </div> 
  </div>
  <!-- END: CONTENT -->
</section>