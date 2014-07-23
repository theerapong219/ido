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

    if(!empty($this->attr['menu_code'])){
      $where .= "menu_code = {$this->attr['menu_code']} AND ";
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
      $result['row'][$i]['code']=$value['code'];
      $result['row'][$i]['_id']=sprintf("%05d", $value['code']);
      foreach((array)$column as $j => $item){
        $result['row'][$i]['item'][]=$value[$item];
      }  
    }  

    return $result;
  }

  public function LoadMainMenu($code){
		$sql="
			SELECT
				*
			FROM
				menus
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

  private function LoadCboMenu(){
		$sql="
			SELECT
				code, 
        CONCAT(id, ' : ', name) AS name
			FROM
				menus
      WHERE
        enable = 'Y'
      ORDER BY
        sort
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
    $result['menu'] = $this->LoadCboMenu();
    
    return $result;
  }

}
?>





























