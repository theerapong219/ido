<?php
/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 11/09/2554 01:30
*  Module : Compile
*  Description : _SEARCH_ _VIEWLIST_ _ADDEDIT_
*  Involve People : -
*  Last Updated : 11/09/2554 01:30
==================================================*/
function Add(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];

  $obj = new SubClass($table);  
  $data = $_POST['data'];
  
  if(!$obj->CheckTable()){
    $obj->CreateTable($table, $data);
  }
          
  $data['user_create'] = $user;
  $data['user_update'] = $user;
  $data['date_create'] = DateNow();
  $data['date_update'] = DateNow();
  $result = $obj->Add($table, $data);
  
  $obj->Log('ADD', $table, $result['code'], $user);
  
  echo json_encode($result);  
}

function Edit(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  
  $obj = new SubClass($table);
  $data = $_POST['data'];
  $data['user_update'] = $user;
  $data['date_update'] = DateNow();
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
?>