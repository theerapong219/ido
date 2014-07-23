<?php
/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 11/09/2554 01:30
*  Module : 
*  Description : 
*  Involve People : -
*  Last Updated : 11/09/2554 01:30
==================================================*/
if($_SESSION[OFFICE]["LOGIN"] != "ON"){
  echo PleaseLogin(URL);
  exit;
}

$mod = $_GET['mod'];
$app = new AppClass();

$menus = $app->Load('menus', array('enable'=>'Y'), 'sort asc');
$menus_sub = $app->LoadStep('menus_sub', 'menu_code', array('enable'=>'Y'), 'sort asc');
$permiss = $app->LoadEmpPermission($_SESSION[OFFICE]['DATA']['code']);
$permiss['empedit'][] = 'VIEW';
$permiss['empedit'][] = 'EDIT';
$permiss['emppass'][] = 'VIEW';
$permiss['emppass'][] = 'EDIT';

if($_SESSION[OFFICE]['DATA']['level'] >= 4){
  $per_add = true;
  $per_edit = true;
  $per_del = true;
}else{
  $per_add = false;
  $per_edit = false;
  $per_del = false;

  if(empty($_GET['parent'])){
    if(!InArray('VIEW', $permiss[$_GET['mod']])){
      exit;
    }
    if(InArray('ADD', $permiss[$_GET['mod']])){
      $per_add = true;
    }
    if(InArray('EDIT', $permiss[$_GET['mod']])){
      $per_edit = true;
    }
    if(InArray('DEL', $permiss[$_GET['mod']])){
      $per_del = true;
    }
  }else{
    if(!InArray('VIEW', $permiss[$_GET['parent'].'-'.$_GET['mod']])){
      exit;
    }
    if(InArray('ADD', $permiss[$_GET['parent'].'-'.$_GET['mod']])){
      $per_add = true;
    }
    if(InArray('EDIT', $permiss[$_GET['parent'].'-'.$_GET['mod']])){
      $per_edit = true;
    }
    if(InArray('DEL', $permiss[$_GET['parent'].'-'.$_GET['mod']])){
      $per_del = true;
    }
  }  
}

if(empty($_GET['parent'])){
  $mymenu = $app->LoadOne('menus', array('id'=>$_GET['mod']));
}else{
  $mymenu = $app->LoadOne('menus_sub', array('id'=>$_GET['mod']));
  $parentmenu = $app->LoadOne('menus', array('id'=>$_GET['parent']));
}

//PrintR($permiss);

$mod = $mymenu['id'];

if(is_file("module/$mod/$mod.setup.php")){
  include "module/$mod/$mod.setup.php";
}

if(is_file("module/$mod/$mod.page.php")){
  include "module/$mod/$mod.page.php";
  exit;
}
?>
