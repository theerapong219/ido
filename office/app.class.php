<?php
/*=========================================
*  Author : Tirapant Tongpann
*  Created Date : 08/08/2011 14:42
*  Module : Class
*  Description : -
*  Involve People : -
*  Last Updated : 08/08/2011 14:42
=========================================*/

class AppClass extends SuperClass{

  public function __construct($table=''){
    $this->table = $table;
	} 
  
  public function LoadEmpPermission($code){
    $sql="
      SELECT
        *
      FROM
        emp_permissions
      WHERE
        emp_code = '$code'
      ORDER BY
        menu_id, pertype
		";
//    echo $sql;
    $result = array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_assoc($query)){
      $result[$row['menu_id']][]=$row['pertype'];
		}
		mysql_free_result($query);
    
		return $result;
  }
}
?>





























