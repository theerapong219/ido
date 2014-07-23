<?php
/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 11/09/2554 01:30
*  Module : 
*  Description : 
*  Involve People : -
*  Last Updated : 11/09/2554 01:30
==================================================*/
header("Content-type: text/html; charset=utf-8");
session_start();

require_once "../service/service.php";

require_once "../main/main.class.php";
require_once "app.class.php";
require_once "app.init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php echo SITE; ?> :: <?php echo $mymenu['name']; ?></title>
<link rel="shortcut icon" href="img/ico/favicon.png" />

<link href="scripts/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="scripts/vendor/bootstrap-jasny/dist/extend/css/jasny-bootstrap.min.css" rel="stylesheet" />
<link href="scripts/vendor/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"  />
<link href="scripts/vendor/select2/select2.css" rel="stylesheet" type="text/css" />
<link href="scripts/vendor/select2/select2-bootstrap.css" rel="stylesheet" type="text/css" />
<link href="scripts/vendor/jquery.uniform/themes/default/css/uniform.default.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/flag/flag.css" rel="stylesheet" type="text/css" />

<link href="../plugin/messenger/css/messenger.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-spinner.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-theme-air.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-theme-block.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-theme-flat.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-theme-future.min.css" rel="stylesheet" type="text/css" />
<link href="../plugin/messenger/css/messenger-theme-ice.min.css" rel="stylesheet" type="text/css" />  

<link href="../plugin/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />  
<link href="../plugin/plupload/src/javascript/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" type="text/css" media="screen" />  

<link href="scripts/css/ark.css" rel="stylesheet" type="text/css" />
<?php
  if(is_file("module/$mod/$mod.style.php")){
    include "module/$mod/$mod.style.php";
  }
?>  
<link rel="stylesheet" type="text/css" href="app.style.css" media="all"  />
<link rel="stylesheet" type="text/css" href="<?php echo "module/$mod/$mod.style.css"; ?>" media="all"  />
</head>

  <body class="cover">

    <div class="wrapper">

      <!-- HEAD NAV -->
      <?php include 'app.header.php'; ?>
      <!-- END: HEAD NAV -->

      <!-- BODY -->
      <div class="body">

        <!-- SIDEBAR -->
        <?php include 'app.menu.php'; ?>
        <!-- END: SIDEBAR -->
        
        <?php 
        if(is_file("module/$mod/$mod.content.php")){
          include "module/$mod/$mod.content.php";
        }else{
          include 'app.content.php'; 
        }
        ?>
      </div>
      <!-- END: BODY -->
    </div>

<!-- JS -->
<script src="scripts/vendor/jquery/jquery.min.js"></script>
<script src="scripts/vendor/jquery-ui/js/jquery-ui.min.js"></script>
<!--<script src="scripts/vendor/jquery.uniform/jquery.uniform.min.js"></script>-->
<script src="scripts/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="scripts/vendor/bootstrap-jasny/dist/extend/js/jasny-bootstrap.min.js"></script>
<!--<script src="scripts/vendor/jquery-autosize/jquery.autosize.min.js"></script>-->
<script src="scripts/vendor/moment/min/moment.min.js"></script>
<!--<script src="scripts/vendor/select2/select2.min.js"></script>-->
<script src="../plugin/messenger/js/messenger.min.js"></script>
<script src="../plugin/messenger/js/messenger-theme-flat.js"></script>
<script src="../plugin/messenger/js/messenger-theme-future.js"></script>
<script src="../plugin/plupload/src/javascript/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.gears.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.silverlight.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.flash.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.browserplus.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.html4.js"></script>
<script src="../plugin/plupload/src/javascript/plupload.html5.js"></script>
<script src="../plugin/plupload/js/i18n/th.js"></script>
<script src="../plugin/ckeditor/ckeditor.js"></script>
<script src="../plugin/ckeditor/adapters/jquery.js"></script>
<script src="../plugin/datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script src="../plugin/datetimepicker/js/locales/bootstrap-datetimepicker.th.js" charset="UTF-8"></script>

<script src="scripts/js/ark.min.js"></script>
<script src="../main/main.func.js" charset="utf-8"></script>
<script src="app.script.js" charset="utf-8"></script>
<script>
$(document).ready(function(){
  me.mod = '<?php echo $mod; ?>';
  me.menu = '<?php echo (empty($_GET['parent']))?$mod:$_GET['parent']; ?>';
  me.submenu = '<?php echo (empty($_GET['parent']))?'':$mod; ?>';
  me.Init();    
  me.permission.add = '<?php echo $per_add; ?>';
  me.permission.edit = '<?php echo $per_edit; ?>';
  me.permission.del = '<?php echo $per_del; ?>';
});
</script>
<script src="<?php echo "module/$mod/$mod.script.js"; ?>" charset="utf-8"></script>  
  </body>
</html>