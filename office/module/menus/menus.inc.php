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
  $datenow = DateNow();

  $obj = new SubClass($table);  
  $data = $_POST['data'];
  $submenu = (array)$_POST['submenu'];
          
  $data['user_create'] = $user;
  $data['user_update'] = $user;
  $data['date_create'] = $datenow;
  $data['date_update'] = $datenow;
  $result = $obj->Add($table, $data);
  
  foreach($submenu as $i => $value){
    $value['menu_code'] = $result['code'];
    $value['user_create'] = $user;
    $value['user_update'] = $user;
    $value['date_create'] = $datenow;
    $value['date_update'] = $datenow;
    $obj->Add('menus_sub', $value);
  }
  
  $obj->Log('ADD', $table, $result['code'], $user);
  
  echo json_encode($result);  
}

function Edit(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $datenow = DateNow();
  
  $obj = new SubClass($table);
  $obj->attr['code'] = $_POST['code'];
  $data = $_POST['data'];
  $submenu = (array)$_POST['submenu'];
  $data['user_update'] = $user;
  $data['date_update'] = $datenow;
  $result = $obj->Edit($table, $data, array('code'=>$_POST['code']));
  
  $obj->ClearSubmenu();
  foreach($submenu as $i => $value){
    $value['menu_code'] = $_POST['code'];
    $value['user_create'] = $user;
    $value['user_update'] = $user;
    $value['date_create'] = $datenow;
    $value['date_update'] = $datenow;
    $obj->Add('menus_sub', $value);
  }
  
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
  $result['submenu'] = $obj->LoadSubmenu();
  
  echo json_encode($result);
}

function View(){
  global $table;
  $obj = new SubClass($table);
  $obj->attr = $_POST;
  $result = $obj->View();
  
  echo json_encode($result);
}

switch($_REQUEST["mode"]){
  case "Add" : Add(); break;
  case "Edit" : Edit(); break;
  case "Del" : Del(); break;
  case "View" : View(); break;
  case "Load" : Load(); break;
  default : echo '{"success":"FAIL"}';
}
?>