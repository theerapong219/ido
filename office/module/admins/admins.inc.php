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
$root = Root();

require_once "$root/main/main.class.php";
require_once "$root/backoffice/app.inc.php";
require_once "$root/backoffice/module/$table/$table.class.php";

function LoadCbo(){
  global $conn;
  global $db;

  $obj = new SubClass($conn, $db);
  $temp = $obj->Select('branchs');
  $branch = array();
  foreach((array)$temp as $i => $value){
    $branch[] = array(
      'id' => $value['code'],
      'name' => $value['branch_name']
    );
  }
  $result['branch'] = $branch;
  
  echo json_encode($result);
}

function AddLocal(){
  global $conn;
  global $db;
  $user = $_SESSION[BACKOFFICE]['DATA']['name'].' '.$_SESSION[BACKOFFICE]['DATA']['surname'];

  $obj = new SubClass($conn, $db, $_GET['mod']);
  $data = $_POST['data'];  
  $data['user_pass'] = sha1(md5($data['user_pass']));
  $data['userCreate'] = $user;
  $data['userUpdate'] = $user;
  
  $result = $obj->Add($_GET['mod'], $data);
  
  $obj->LogBackoffice('ADD', $_GET['mod'], $result['code'], $user);
  
  echo json_encode($result);  
}

function EditLocal(){
  global $conn;
  global $db;
  $user = $_SESSION[BACKOFFICE]['DATA']['name'].' '.$_SESSION[BACKOFFICE]['DATA']['surname'];

  $obj = new SubClass($conn, $db, $_GET['mod']);
  $data = $_POST['data'];
  if(empty($data['user_pass'])){
    unset($data['user_pass']);
  }else{
    $data['user_pass'] = sha1(md5($data['user_pass']));
  }
  $data['userUpdate'] = $user;
  $result = $obj->Edit($_GET['mod'], $data, array('code'=>intval($_POST['code'])));
  
  $obj->LogBackoffice('EDIT', $_GET['mod'], $_POST['code'], $user);
  
  echo json_encode($result);  
}

function LoadLocal(){
  global $conn;
  global $db;
  $user = $_SESSION[BACKOFFICE]['DATA']['name'].' '.$_SESSION[BACKOFFICE]['DATA']['surname'];

  $obj = new SubClass($conn, $db, $_GET['mod']);
  $tmp = $obj->Select($_GET['mod'], "{code:{$_GET['code']}}");
  $data = (array)$tmp[0];
  unset($data['user_pass']);
          
  foreach($data as $i => $value){
    if(Find('__', $i)){
      foreach((array)$value as $j => $item){
        $result['row'][] = array('name'=>$i.$j, 'value'=>$item);
      }
    }else{
      $result['row'][] = array('name'=>$i, 'value'=>$value);
    }
  }
  
  $obj->LogBackoffice('LOAD', $_GET['mod'], $_GET['code'], $user);
  
  echo json_encode($result);
}

switch($_REQUEST["mode"]){
  case "Add" : AddLocal(); break;
  case "Edit" : EditLocal(); break;
  case "Del" : Del(); break;
  case "View" : View(); break;
  case "Load" : LoadLocal(); break;
  case "LoadCbo" : LoadCbo(); break;
  default : echo '{"success":"FAIL"}';
}
?>