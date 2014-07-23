<?php
/*=========================================
*  Author : Tirapant Tongpann
*  Created Date : 08/08/2011 14:42
*  Module : Class
*  Description : -
*  Involve People : -
*  Last Updated : 08/08/2011 14:42
=========================================*/

class SubClass extends SuperClass{

  public function __construct($conn, $db, $table=''){
    $this->conn = $conn;
    $this->db = $db;
    $this->table = $table;
	}
}
?>





























