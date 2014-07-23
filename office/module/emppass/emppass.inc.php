<?php
/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : inc
*  Description : Backoffice Include
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

header("Content-type: text/html; charset=utf-8");
session_start();

require_once "../../../service/service.php";
$table = $_GET['mod'];

require_once "../../../main/main.class.php";
require_once "$table.class.php";
$table = 'employees';

function Edit(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $code = $_SESSION[OFFICE]['DATA']['code'];
  
  $obj = new SubClass($table);
//  PrintR($_POST); 
  $old_pass = md5($_POST['data']['old_pass']);
  $emp = $obj->LoadOne($table, array('code'=>$code));
//  PrintR($emp);
  
  if($old_pass == $emp['user_pass']){
    if($_POST['data']['new_pass'] == $_POST['data']['new_pass_again']){
      $data['user_pass'] = md5($_POST['data']['new_pass']);
      $data['user_update'] = $user;
      $data['date_update'] = DateNow();
      $result = $obj->Edit($table, $data, array('code'=>$code));

      $obj->Log('EDIT', $table, $code, $user, $result['log']);
      unset($result['log']);
    }else{
      $result['success'] = 'NEWPASS';
    }
  }else{
    $result['success'] = 'OLDPASS';
  }
  
  
  echo json_encode($result);
}

switch($_REQUEST["mode"]){
  case "Edit" : Edit(); break;
  default : echo '{"success":"FAIL"}';
}
?>