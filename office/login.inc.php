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
include "../main/main.class.php";
include "login.class.php";

$obj = new SubClass();

$obj->attr['user_name'] = $_POST['user'];
$obj->attr['user_pass'] = md5($_POST['pass']);

$login = $obj->Login();

session_register(OFFICE);

$_SESSION[OFFICE]['LOGIN'] = 'OFF';
$_SESSION[OFFICE]['DATA'] = array();

if(strcmp($login['user_pass'], $obj->attr["user_pass"])==0){	
  $_SESSION[OFFICE]['LOGIN'] = 'ON';
  $_SESSION[OFFICE]['DATA'] = $login;
  
  $result['success'] = 'COMPLETE';
  $result['url'] = URL.'/office/app.php?mod=home';
}else{
  $result['success'] = 'FAIL';
}
//print_r($_SESSION);

echo json_encode($result);
?>