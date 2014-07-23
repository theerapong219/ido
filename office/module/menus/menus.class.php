<?php
/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : Class
*  Description : Backoffice Class
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

function EnableDisplay($value){
  if($value=='Y'){
    return '<label class="label label-success">เปิด</label>';
  }else{
    return '<label class="label label-default">ปิด</label>';
  }
}

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
    
    $submenu = $this->LoadSubmenuCount();
    foreach((array)$tmp as $i => $value){    
      $cnt = intval($submenu[$value['code']]);
      if($cnt==0){
        $cnt='&nbsp;';
      }
      
      $result['row'][$i]['code']=$value['code'];

      $result['row'][$i]['item'][]=$value['code'];
      $result['row'][$i]['item'][]=$value['name'];
      $result['row'][$i]['item'][]='<i class="fa '.$value['icon'].'"></i>';
      $result['row'][$i]['item'][]=$value['sort'];
      $result['row'][$i]['item'][]=EnableDisplay($value['enable']);
      $result['row'][$i]['item'][]=$cnt;
    }  

    return $result;
  }

	public function LoadSubmenuCount(){
    $sql="
      SELECT
        menu_code, COUNT(code) AS cnt
      FROM
        menus_sub
      GROUP BY
        menu_code 
      ORDER BY
        menu_code
		";
//    echo $sql;
    $result = array();
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_object($query)){
      $result[$row->menu_code]=$row->cnt;
		}
		mysql_free_result($query);
    
		return $result;
	}

	public function LoadSubmenu(){
    $sql="
      SELECT
        *
      FROM
        menus_sub
      WHERE
        menu_code = '".$this->attr['code']."'
      ORDER BY
        sort
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

	public function ClearSubmenu(){
    $sql="
      DELETE FROM menus_sub
      WHERE
        menu_code = '".$this->attr['code']."'
		";
//    echo $sql;
		$query=mysql_query($sql) or die(mysql_error());
	}
}
?>





























