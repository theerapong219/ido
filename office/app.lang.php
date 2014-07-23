<?php
/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : inc
*  Description : Office Include
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

header("Content-type: text/html; charset=utf-8");
session_start();

include "../service/service.php";

if($_GET['lang'] == 'TH'){
  $_SESSION[OFFICE]['LANG'] = 'TH';
  $result['success'] = 'COMPLETE';
}elseif($_GET['lang'] == 'EN'){
  $_SESSION[OFFICE]['LANG'] = 'EN';
  $result['success'] = 'COMPLETE';
}else{
  $result['success'] = 'FAIL';
}

echo json_encode($result);
?>