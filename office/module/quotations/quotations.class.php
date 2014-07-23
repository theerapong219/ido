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
    
    $service = $this->LoadService();
    foreach((array)$tmp as $i => $value){    
      $result['row'][$i]['code']=$value['code'];
      $result['row'][$i]['status']=$value['status'];
      
      $result['row'][$i]['item'][]=$start+$i+1; 
      $result['row'][$i]['item'][]=$value['id']; 
      $result['row'][$i]['item'][]=DateDisplay($value['date_start'], 9); 
      $result['row'][$i]['item'][]=DateDisplay($value['date_stop'], 9); 
      $result['row'][$i]['item'][]=$value['customer_th']; 
      $result['row'][$i]['item'][]=$service[$value['service_code']];  
      $result['row'][$i]['item'][]=$value['scope_th']; 
      $result['row'][$i]['item'][]=$value['employee_no'];  
      $result['row'][$i]['item'][]=NumberDisplay($value['manday_total'], 0);
      $result['row'][$i]['item'][]=NumberDisplay($value['total']);
    }  

    return $result;
  }

  public function LoadQuotDesc(){
		$sql="
			SELECT
				*
			FROM
				quot_desc
      WHERE
        quot_code = '".$this->attr['code']."'
      ORDER BY
        code
		";
//		echo $sql;
    $result=array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_assoc($query)){
			$result[]=$row;
		}
		mysql_free_result($query);

    return $result;
  }

  public function LoadQuotation(){
		$sql="
			SELECT
				*
			FROM
				quotations
      WHERE
        code = '".$this->attr['code']."'
		";
//		echo $sql;
    $result=array();
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_assoc($query)){
      $row['date_approve'] = DateTimeDisplay($row['date_approve'], 9);
      $row['date_reject'] = DateTimeDisplay($row['date_reject'], 9);
			$result=$row;
		}
		mysql_free_result($query);

    return $result;
  }

  public function LoadCustomerDetail($code){
		$sql="
			SELECT
				*
			FROM
				customers
      WHERE
        code = '$code'
		";
//		echo $sql;
    $result=array();
		$query=mysql_query($sql) or die(mysql_error());
		if($row=mysql_fetch_assoc($query)){
			$result=$row;
		}
		mysql_free_result($query);

    return $result;
  }

  public function DelQuotDesc(){
		$sql="
			DELETE FROM
				quot_desc
      WHERE
        quot_code = '".$this->attr['code']."'
		";
//		echo $sql;
		$query=mysql_query($sql) or die(mysql_error());
  }

  private function LoadService(){
		$sql="
			SELECT
				code, 
        id AS name
			FROM
				services
      ORDER BY
        code
		";
//		echo $sql;
    $result[0]='';
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_object($query)){
			$result[$row->code]=$row->name;
		}
		mysql_free_result($query);

    return $result;
  }

  private function LoadEmployee(){
		$sql="
			SELECT
				code, 
        name
			FROM
				employees
      ORDER BY
        code
		";
//		echo $sql;
    $result[0]='';
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_object($query)){
			$result[$row->code]=$row->name;
		}
		mysql_free_result($query);

    return $result;
  }

  private function LoadCboEmployee(){
		$sql="
			SELECT
				code, 
        name
			FROM
				employees
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

  private function LoadCboService(){
		$sql="
			SELECT
				code, 
        id AS name
			FROM
				services
      ORDER BY
        code
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

  private function LoadCboCustomer(){
		$sql="
			SELECT
				code, 
        customer_th AS name
			FROM
				customers
      ORDER BY
        customer_th
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
    
	public function CreateQuotId($accr){
		$sql="
      (SELECT
        CONCAT(CONCAT('IV', DATE_FORMAT(CURRENT_DATE, '%Y') - 1957),
        LPAD(SUBSTR(id, 5, 5) * 1 + 1, 5, '0')) AS id
      FROM
        invoices
      WHERE
        mycompanyId = '$mycompanyId' AND
        SUBSTR(id, 3, 2) = DATE_FORMAT(CURRENT_DATE, '%Y') - 1957 AND
        id <> '' AND
        active = 'Y'
      ORDER BY
        id DESC
      LIMIT
        0, 1)

      UNION

      (SELECT
        CONCAT(CONCAT('IV', DATE_FORMAT(CURRENT_DATE, '%Y') - 1957), '00001') AS id
      FROM
        dual)

      LIMIT
        0, 1  
    ;";
//		echo "<pre>$sql</pre>";
		$query=mysql_query($sql);
		if($row=mysql_fetch_object($query)){
      $result=$row->id;
		}
		mysql_free_result($query);

		return $result;
	}
  
  public function LoadCbo(){
    $result['service'] = $this->LoadCboService();
    $result['cus'] = $this->LoadCboCustomer();
    $result['emp'] = $this->LoadCboEmployee();
    
    return $result;
  }
}
?>





























