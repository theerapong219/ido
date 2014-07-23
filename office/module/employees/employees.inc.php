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

function Add(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];

  $obj = new SubClass($table);
  $data = $_POST['data'];
  $data['user_pass'] = md5($data['user_pass']);
  $data['user_create'] = $user;
  $data['user_update'] = $user;
  $data['date_create'] = DateNow();
  $data['date_update'] = DateNow();
  $result = $obj->Add($table, $data);
//  echo $obj->sql;
  
  $obj->Log('ADD', $table, $result['code'], $user);
  
  echo json_encode($result);  
}

function Edit(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $datenow = DateNow();
  
  $obj = new SubClass($table);
  $data = $_POST['data'];
  $permission = (array)$_POST['permission'];
  $img = (array)$_POST['img'];
//  PrintR($permission);
  
  if($_POST['data']['change_pass'] == 'Y'){
    $data['user_pass'] = md5($data['user_pass']);
    unset($data['change_pass']);
  }else{
    unset($data['change_pass']);
    unset($data['user_pass']);
  }
  
  $data['user_update'] = $user;
  $data['date_update'] = $datenow;
  $result = $obj->Edit($table, $data, array('code'=>$_POST['code']));
  
  $obj->Log('EDIT', $table, $_POST['code'], $user, $result['log']);
  unset($result['log']);
  
  echo json_encode($result);
}

function Del(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];

  $obj = new SubClass($table);
  $result = $obj->Del($table, array('code'=>$_POST['code']));
  
  $obj->Log('DEL', $table, $_POST['code'], $user, $result['log']);
  unset($result['log']);
  
  echo json_encode($result);
}

function Load(){
  global $table;
  $obj = new SubClass($table);
  $obj->attr = $_GET;
  $result = $obj->LoadEdit();
  
  echo json_encode($result);
}

function View(){
  global $table;
  $obj = new SubClass($table);
  $obj->attr = $_POST;
  $result = $obj->View();
  
  echo json_encode($result);
}

function LoadCbo(){
  global $table;
  $obj = new SubClass($table);
  $obj->attr = $_GET;
  $result = $obj->LoadCbo();
  
  echo json_encode($result);
}

switch($_REQUEST["mode"]){
  case "Add" : Add(); break;
  case "Edit" : Edit(); break;
  case "Del" : Del(); break;
  case "View" : View(); break;
  case "Load" : Load(); break;
  case "LoadCbo" : LoadCbo(); break;
  default : echo '{"success":"FAIL"}';
}
?>