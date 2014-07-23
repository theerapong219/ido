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

  public function __construct($table=''){
    $this->table = $table;
	}

	public function LoadEdit(){
    $sql="
      SELECT
        *
      FROM
        ".$this->table."
      WHERE
        code = '".$this->attr["code"]."'
		";
//    echo $sql;
    $result['row'] = array();
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_object($query)){
      $data=$row;
		}
		mysql_free_result($query);

    unset($data->user_pass);
    foreach ((object)$data as $key => $value) {
      $result['row'][]=array(
        'name' => $key,
        'value' => $value
      );
    }
    
    $result['firstcode'] = $this->LoadFirstCode();
    $result['lastcode'] = $this->LoadLastCode();
    $result['prevcode'] = $this->LoadPrevCode();
    $result['nextcode'] = $this->LoadNextCode();
    
		return $result;
	}

	public function LoadPermission(){
    $sql="
      SELECT
        *
      FROM
        permissions
      ORDER BY
        pertype, menu_id
		";
//    echo $sql;
    $result = array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_assoc($query)){
      $result[$row['pertype']][]=$row;
		}
		mysql_free_result($query);
    
		return $result;
	}

	public function DelEmpPermission($code){
    $sql="
      DELETE FROM
        emp_permissions
      WHERE
        emp_code = '$code'
		";
//    echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
	}

	public function DelEmpPic($code){
    $sql="
      DELETE FROM
        emp_pics
      WHERE
        emp_code = '$code'
		";
//    echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
	}

	public function LoadEmpPermission(){
    $sql="
      SELECT
        *
      FROM
        emp_permissions
      WHERE
        emp_code = '".$this->attr["code"]."'
      ORDER BY
        menu_id, pertype
		";
//    echo $sql;
    $result = array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_assoc($query)){
      $result[]=$row;
		}
		mysql_free_result($query);
    
		return $result;
	}

	public function LoadEmpPic(){
    $sql="
      SELECT
        *
      FROM
        emp_pics
      WHERE
        emp_code = '".$this->attr["code"]."'
      ORDER BY
        code
		";
//    echo $sql;
    $result = array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_assoc($query)){
      $result[]=$row['id'];
		}
		mysql_free_result($query);
    
		return $result;
	}

  private function LoadCboProvince(){
		$sql="
			SELECT
				code, 
        name
			FROM
				provinces
      ORDER BY
        name
		";
//		echo $sql;
    $result=array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_object($query)){
			$result[]=array(
        'code' => $row->code,
        'name' => $row->name
      );
		}
		mysql_free_result($query);

    return $result;
  }
  
  public function LoadCbo(){
    $result['province'] = $this->LoadCboProvince();
    
    return $result;
  }
}
?>





























