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

  public function __construct(){
	}

	public function Login(){
		$sql="
			SELECT
        *, NOW() AS datenow
			FROM
        employees
			WHERE
        user_name = '".$this->attr["user_name"]."' AND
        level > 1 AND
				enable = 'Y'
		";
//		echo $sql;

		$query = mysql_query($sql) or die(mysql_error());
    $result=array();
		if($row=mysql_fetch_assoc($query)){
      $result=$row;
		}

		mysql_free_result($query);
		return $result;
	}
}
?>





























