<?php
/*=========================================
*  Author : Tirapant Tongpann
*  Created Date : 27/6/2552 0:49
*  Module : Class Main
*  Description : -
*  Involve People : -
*  Last Updated : 27/6/2552 0:49
=========================================*/

class SuperClass{
  public $table = '';
  public $attr = array();
	public $error = array();
  public $sql = '';
  
	public function Log($mode, $menu, $record, $user, $item=array()){
    if(empty($item)){
      $log = '';
    }else{
      $log = var_export($item, true);
      $log = mysql_real_escape_string($log);
    }
//    echo $log;
    
    $sql="
      INSERT INTO logs (mode, menu, record, item, user_create, date_create)
      VALUES(
        '$mode', '$menu', '$record', '$log', '$user', NOW()
      )
    ";
//    echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
	}  
  
	public function Add($table='', $data=array()){
    if(!empty($data)){
      $attribute_arr = array();
      $values_arr = array();
      
      foreach($data as $fields => $val){
        $attribute_arr[] = $fields;
        $values_arr[] ="'$val'";
      }
      $attribute = implode(',', $attribute_arr);
      $values = implode(',', $values_arr);
      $sql="
        INSERT INTO $table ($attribute)
        VALUES($values);
      ";
//      echo $sql;
      $this->sql = $sql;

      $query=mysql_query($sql) or die(mysql_error());
      if($query){
        $result['success'] = 'COMPLETE';
        $result['code'] = mysql_insert_id();
      }else{
        $result['success'] = 'FAIL';
        $this->error[] = 'QUERY ERROR';
      }
    }else{
			$result['success'] = 'FAIL';
      $this->error[] = 'NOT FOUND DATA';
    }
    
    return $result;
	}  
  
	public function Edit($table='', $data=array(), $where=array()){
    if(!empty($data)){
      $attribute_arr = array();
      $where_arr = array();
      
      foreach($data as $fields => $value){
        $value = mysql_real_escape_string($value);
        $attribute_arr[] = " $fields = '$value' ";
      }
      foreach($where as $fields => $value){
        $value = mysql_real_escape_string($value);
        $where_arr[] = " $fields = '$value' ";
      }
      $attribute = implode(', ', $attribute_arr);
      $whereqry = implode(' AND ', $where_arr);
      
      $sql="SELECT * FROM $table WHERE $whereqry ";
      $query = mysql_query($sql);
      $log = array();
      while($row=mysql_fetch_assoc($query)){
        $log[] = $row;
      }
      
      $sql="
        UPDATE $table SET
          $attribute
        WHERE 
          $whereqry
      ";
      $this->sql = $sql;

      $query=mysql_query($sql) or die(mysql_error());
      if($query){
        $result['success'] = 'COMPLETE';
        $result['log'] = $log;
      }else{
        $result['success'] = 'FAIL';
        $this->error[] = 'QUERY ERROR';
      }
    }else{
			$result['success'] = 'FAIL';
      $this->error[] = 'NOT FOUND DATA';
    }
    
    return $result;
	}  
  
	public function Del($table='', $where=array()){
    if(!empty($where)){
      $where_arr = array();
      
      foreach($where as $fields => $value){
        $value = mysql_real_escape_string($value);
        $where_arr[] = " $fields = '$value' ";
      }
      $whereqry = implode(' AND ', $where_arr);
      
      $sql="SELECT * FROM $table WHERE $whereqry ";
      $query = mysql_query($sql);
      $log = array();
      while($row=mysql_fetch_assoc($query)){
        $log[] = $row;
      }
      
      $sql="
        DELETE FROM
          $table
        WHERE
          $whereqry
      ";
      $this->sql = $sql;

      $query=mysql_query($sql) or die(mysql_error());
      if($query){
        $result['success'] = 'COMPLETE';
        $result['log'] = $log;
      }else{
        $result['success'] = 'FAIL';
        $this->error[] = 'QUERY ERROR';
      }
    }else{
			$result['success'] = 'FAIL';
      $this->error[] = 'NOT FOUND DATA';
    }
    
    return $result;
	}  

	public function Load($table, $where=array(), $orderby='', $limit=''){
    if(!empty($where)){
      $arr = array();
      foreach((array)$where as $i => $item){
        $item = mysql_real_escape_string($item);
        $arr[] = "$i = '$item'";
      }

      $qrywhere = implode(' AND ', $arr);
    }
    if(!empty($orderby)){
      $orderby = "ORDER BY $orderby";
    }
    if(!empty($limit)){
      $limit = "ORDER BY $limit";
    }
		$sql="
      SELECT * 
      FROM $table 
      WHERE
        $qrywhere
        AND 1
      $orderby
      $limit
    ";
//    echo $sql;
    
    $this->sql = $sql;

    $query = mysql_query($sql);
    $result = array();
    while($row=mysql_fetch_assoc($query)){
      $result[] = $row;
    }
		return $result;
	}

	public function LoadStep($table, $step, $where=array(), $orderby='', $limit=''){
    if(!empty($where)){
      $arr = array();
      foreach((array)$where as $i => $item){
        $item = mysql_real_escape_string($item);
        $arr[] = "$i = '$item'";
      }

      $qrywhere = implode(',', $arr);
    }
    if(!empty($orderby)){
      $orderby = "ORDER BY $orderby";
    }
    if(!empty($limit)){
      $limit = "ORDER BY $limit";
    }
		$sql="
      SELECT * 
      FROM $table 
      WHERE
        $qrywhere
        AND 1
      $orderby
      $limit
    ";
    $this->sql = $sql;

    $query = mysql_query($sql);
    $result = array();
    while($row=mysql_fetch_assoc($query)){
      $result[$row[$step]][] = $row;
    }
		return $result;
	}

	public function LoadOne($table, $where=array(), $orderby=''){
    if(!empty($where)){
      $arr = array();
      foreach((array)$where as $i => $item){
        $item = mysql_real_escape_string($item);
        $arr[] = "$i = '$item'";
      }

      $qrywhere = implode(' AND', $arr);
    }
    if(!empty($orderby)){
      $orderby = "ORDER BY $orderby";
    }
		$sql="
      SELECT 
        * 
      FROM 
        $table 
      WHERE
        $qrywhere
        AND 1
      $orderby
      LIMIT 0, 1
    ";
    $this->sql = $sql;

    $query = mysql_query($sql);
    $result = array();
    if($row=mysql_fetch_assoc($query)){
      $result = $row;
    }
		return $result;
	}

	public function CreateCode($table){
		$sql="SELECT MAX(code) AS code FROM $table ORDER BY code DESC";

		$query=mysql_query($sql);
		if($row=mysql_fetch_object($query)){
			$num=intval($row->code);
			$Code=$num+1;
		}else{
			$Code=1;
		}

		mysql_free_result($query);
		return $Code;
	}

  public function View(){
    $table = $this->table;
    $column = $this->attr['column'];
    $page = $this->attr['page'];
    $limit = $this->attr['limit'];
    $start = (($page - 1) * $limit);
    $search = (array)$this->attr['search'];
    $searchkey = $this->attr['searchkey'];
    $sortby = $this->attr['sortby'];
    $sortorder = $this->attr['sortorder'];

    foreach($search as $i => $value){
      $searchby = $value['searchby'];
      $searchkey = $value['searchkey'];
      if(!empty($searchby) && (!empty($searchkey))){
        $where .= "$searchby LIKE '%$searchkey%' AND ";
      }
    }

		$sql="SELECT COUNT(*) AS cnt FROM $table WHERE $where 1";
    $query = mysql_query($sql);
    $count = 0;
    if($row=mysql_fetch_object($query)){
      $count = $row->cnt;
    }    
    $allpage = ceil($count / $limit);

    $pp = $page - 1;
    if($pp < 1){
      $pp = 1;
    }
    $np = $page + 1;
    if($np > $allpage){
      $np = $allpage;
    }

    $beginpage = $page - 2;
    if($beginpage < 1){
      $beginpage = 1;
    }
    $endpage = $beginpage + 4;
    if($endpage > $allpage){
      $endpage = $allpage;
    }

    $runpage = array();
    for($i=$beginpage; $i<=$endpage; $i++){
      $runpage[] = $i;
    }

    
		$sql="
      SELECT 
        * 
      FROM $table 
      WHERE 
        $where 1 
      ORDER BY 
        $sortby $sortorder
      LIMIT $start, $limit
    ;";
//    PrintR($sql);
    
    $query = mysql_query($sql);
    $tmp=array();
    while($row=mysql_fetch_assoc($query)){
      $tmp[] = $row;
    }   
//PrintR($tmp);
    $result = array(
      'record' => NumberDisplay($count, 0),
      'row' => array(),
      'page' => array(
        'page' => $page,
        'fp' => 1,
        'pp' => $pp,
        'np' => $np,
        'ep' => $allpage,
        'runpage' => $runpage
      )
    );  
    foreach((array)$tmp as $i => $value){    
//      $result['row'][$i]['_id']=sprintf("%05d", $value['code']);
//      $result['row'][$i]['item'][]=$value[''];
      
      $result['row'][$i]['code']=$value['code'];
      foreach((array)$column as $j => $item){
        $result['row'][$i]['item'][]=$value[$item];
      }  
    }  

    return $result;
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
  
  public function LoadFirstCode(){
    $sql="
      SELECT
        code
      FROM
        ".$this->table."
      ORDER BY
        code
      LIMIT
        0, 1
		";
//    echo $sql;
		$result = 0;
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_object($query)){
      $result = $row->code;
		}
		mysql_free_result($query);
		return $result;    
  }
  
  public function LoadLastCode(){
    $sql="
      SELECT
        code
      FROM
        ".$this->table."
      ORDER BY
        code DESC
      LIMIT
        0, 1
		";
//    echo $sql;
		$result = 0;
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_object($query)){
      $result = $row->code;
		}
		mysql_free_result($query);
		return $result;    
  }
  
  public function LoadPrevCode(){
    $sql="
      SELECT
        code
      FROM
        ".$this->table."
      WHERE
        code < '".$this->attr["code"]."'
      ORDER BY
        code DESC
      LIMIT
        0, 1
		";
//    echo $sql;
		$result = $this->attr["code"];
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_object($query)){
      $result = $row->code;
		}
		mysql_free_result($query);
		return $result;    
  }
  
  public function LoadNextCode(){
    $sql="
      SELECT
        code
      FROM
        ".$this->table."
      WHERE
        code > '".$this->attr["code"]."'
      ORDER BY
        code
      LIMIT
        0, 1
		";
//    echo $sql;
		$result = $this->attr["code"];
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_object($query)){
      $result = $row->code;
		}
		mysql_free_result($query);
		return $result;    
  }
  
  public function CheckTable(){
    $sql="
      check table {$this->table}
		;";
//    echo $sql;
		$result = false;
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_object($query)){
      if($row->Msg_text == 'OK'){
        $result = true;
      }
		}
		mysql_free_result($query);
		return $result; 
  }
  
	public function CreateTable($table='', $data=array()){
    if(!empty($data)){
      $attribute_arr = array();
      
      unset($data['code']);
      unset($data['user_create']);
      unset($data['user_update']);
      unset($data['date_create']);
      unset($data['date_update']);
      
      foreach($data as $fields => $value){
        $value = mysql_real_escape_string($value);
        $attribute_arr[] = "`$fields` varchar(100) NOT NULL DEFAULT '',";
      }
      $attribute = implode("\n", $attribute_arr);
      
      $sql="
        CREATE TABLE `$table` (
          `code` int(11) NOT NULL AUTO_INCREMENT,
          $attribute
          `user_create` varchar(100) NOT NULL,
          `user_update` varchar(100) NOT NULL,
          `date_create` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          `date_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
          PRIMARY KEY (`code`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
      ;";
//      echo$this->sql = $sql;

      $query=mysql_query($sql) or die(mysql_error());
      if($query){
        $result['success'] = 'COMPLETE';
      }else{
        $result['success'] = 'FAIL';
        $this->error[] = 'QUERY ERROR';
      }
    }else{
			$result['success'] = 'FAIL';
      $this->error[] = 'NOT FOUND DATA';
    }
    
    return $result;
	}  
}

?>