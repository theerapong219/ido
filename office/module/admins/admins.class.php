<?php
/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : Class
*  Description : Backoffice Class
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

class SubClass extends SuperClass{

  public function __construct($conn, $db, $table=''){
    $this->conn = $conn;
    $this->db = $db;
    $this->table = $table;
	}
}
?>





























