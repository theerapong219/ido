<div class="navbar navbar-default navbar-static-top navbar-main" role="navigation">
  <div class="navbar-header">
    <ul class="nav navbar-brand">
      <li>
        <a id="Brand" class="dropdown-toggle brand" href="javascript:;"><?php echo SITE; ?></a>
      </li>
<!--      <li class="dropdown">
        <a id="Brand" class="dropdown-toggle brand" data-toggle="dropdown" href="javascript:;"><?php echo SITE; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="javascript:me.ChangeLanguage('TH');"><i class="flag th"></i> ภาษาไทย</a></li>
          <li><a href="javascript:me.ChangeLanguage('EN');"><i class="flag en"></i> English</a></li>
        </ul>
      </li>-->
    </ul>
  </div>
  <ul class="nav navbar-nav navbar-right">
    <li class="visible-xs">
      <a href="#" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars"></i>
      </a>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle avatar pull-right" data-toggle="dropdown">
        <img src="../img/?pic=<?php echo $_SESSION[OFFICE]['DATA']['filepic']; ?>&w=60" alt="mike" class="img-avatar" style="width:40px; height:40px;" />
        <span class="hidden-small"> <?php echo $_SESSION[OFFICE]['DATA']['name']; ?> <b class="caret"></b></span>
      </a>
      <ul class="dropdown-menu pull-right">
        <li><a href="app.php?mod=empedit"><i class="fa fa-gear"></i>แก้ไขข้อมูลส่วนตัว</a></li>
        <li><a href="app.php?mod=emppass"><i class="fa fa-key"></i>แก้ไขรหัสผ่าน</a></li>
        <li class="divider"></li>
        <li><a href="app.logout.php"><i class="fa fa-sign-out"></i>ออกจากระบบ</a></li>
      </ul>
    </li>
  </ul>

</div>