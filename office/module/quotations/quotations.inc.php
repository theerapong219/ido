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
  $desc = $_POST['desc'];
  
  if(empty($data['cus_code'])){
    $cus['customer_en'] = $data['customer_en'];
    $cus['contact_en'] = $data['contact_en'];
    $cus['address_en'] = $data['address_en'];
    $cus['customer_th'] = $data['customer_th'];
    $cus['contact_th'] = $data['contact_th'];
    $cus['address_th'] = $data['address_th'];
    $cus['tel'] = $data['tel'];
    $cus['mobile'] = $data['mobile'];
    $cus['website'] = $data['website'];
    $cus['fax'] = $data['fax'];
    
    $customer = $obj->Add('customers', $cus);
    $data['cus_code'] = $customer['code'];
  }
          
  $netprice = 0;
  foreach((array)$desc as $i => $value){
    $netprice += $value['price'];
  }
  
  $data['total'] = $netprice;
  $data['user_create'] = $user;
  $data['user_update'] = $user;
  $data['date_create'] = $datenow;
  $data['date_update'] = $datenow;
  $result = $obj->Add($table, $data);
  
  foreach((array)$desc as $i => $value){
    $value['quot_code'] = $result['code'];
    $value['user_create'] = $user;
    $value['date_create'] = $datenow;
    $obj->Add('quot_desc', $value);
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
  $desc = $_POST['desc'];
  
  if(empty($data['cus_code'])){
    $cus['name_en'] = $data['customer_en'];
    $cus['contact_en'] = $data['contact_en'];
    $cus['address_en'] = $data['address_en'];
    $cus['name_th'] = $data['customer_th'];
    $cus['contact_th'] = $data['contact_th'];
    $cus['address_th'] = $data['address_th'];
    $cus['tel'] = $data['tel'];
    $cus['mobile'] = $data['mobile'];
    $cus['website'] = $data['website'];
    $cus['fax'] = $data['fax'];
    
    $customer = $obj->Add('customers', $cus);
    $data['cus_code'] = $customer['code'];
  }
  
  $obj->DelQuotDesc();
  $netprice = 0;
  foreach((array)$desc as $i => $value){
    $netprice += $value['price'];
    $value['quot_code'] = $_POST['code'];
    $value['user_create'] = $user;
    $value['date_create'] = $datenow;
    $obj->Add('quot_desc', $value);
  }
  
  $data['total'] = $netprice;
  $data['user_update'] = $user;
  $data['date_update'] = $datenow;
  $result = $obj->Edit($table, $data, array('code'=>$_POST['code']));
  
  $obj->Log('EDIT', $table, $_POST['code'], $user, $result['log']);
  unset($result['log']);
  
  echo json_encode($result);
}

function Approve(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $datenow = DateNow();
  
  $obj = new SubClass($table);
  $obj->attr['code'] = $_POST['code'];
  
  $data['status'] = 1;
  $data['user_approve'] = $user;
  $data['date_approve'] = $datenow;
  $result = $obj->Edit($table, $data, array('code'=>$_POST['code']));
  
  $obj->Log('EDIT', $table, $_POST['code'], $user, $result['log']);
  unset($result['log']);
  
  echo json_encode($result);
}

function Reject(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $datenow = DateNow();
  
  $obj = new SubClass($table);
  $obj->attr['code'] = $_POST['code'];
  
  $data['status'] = 2;
  $data['user_reject'] = $user;
  $data['date_reject'] = $datenow;
  $result = $obj->Edit($table, $data, array('code'=>$_POST['code']));
  
  $obj->Log('EDIT', $table, $_POST['code'], $user, $result['log']);
  unset($result['log']);
  
  echo json_encode($result);
}

function Cancel(){
  global $table;
  $user = $_SESSION[OFFICE]['DATA']['name'].' '.$_SESSION[OFFICE]['DATA']['surname'];
  $datenow = DateNow();
  
  $obj = new SubClass($table);
  $obj->attr['code'] = $_POST['code'];
  
  $data['status'] = 0;
  $data['user_cancel'] = $user;
  $data['date_cancel'] = $datenow;
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
  $result['desc'] = $obj->LoadQuotDesc();
  $result['quot'] = $obj->LoadQuotation();
  
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

function LoadCustomer(){
  global $table;
  $obj = new SubClass($table);
  $obj->attr = $_GET;
  $result = $obj->LoadCustomerDetail($_POST['code']);
  
  echo json_encode($result);
}

switch($_REQUEST["mode"]){
  case "Add" : Add(); break;
  case "Edit" : Edit(); break;
  case "Del" : Del(); break;
  case "View" : View(); break;
  case "Load" : Load(); break;
  case "LoadCbo" : LoadCbo(); break;
  case "LoadCustomer" : LoadCustomer(); break;
  case "Approve" : Approve(); break;
  case "Reject" : Reject(); break;
  case "Cancel" : Cancel(); break;
  default : echo '{"success":"FAIL"}';
}
?>