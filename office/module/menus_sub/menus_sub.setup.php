<?php
/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : inc
*  Description : Backoffice Include
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

include "$mod.class.php";
$obj = new SubClass();

if(!empty($_GET['menu'])){
  $mainmenu = $obj->LoadMainMenu($_GET['menu']);
}
//PrintR($mymenu);
?>