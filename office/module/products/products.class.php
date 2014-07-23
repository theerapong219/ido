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
        if($searchby == 'type_code'){
          $where .= "ct.name LIKE '%$searchkey%' AND ";
        }elseif($searchby == 'cat_code'){
          $where .= "ca.name LIKE '%$searchkey%' AND ";
        }elseif($searchby == 'brand_code'){
          $where .= "bd.name LIKE '%$searchkey%' AND ";
        }elseif($searchby == 'unit_code'){
          $where .= "un.name LIKE '%$searchkey%' AND ";
        }elseif($searchby == 'cost'){
          $where .= "pd.cost = '$searchkey' AND ";
        }elseif($searchby == 'price'){
          $where .= "pd.price = '$searchkey' AND ";
        }elseif($searchby == 'point'){
          $where .= "pd.point = '$searchkey' AND ";
        }elseif($searchby == 'quantity'){
          $where .= "pd.quantity = '$searchkey' AND ";
        }else{
          $where .= "$searchby LIKE '%$searchkey%' AND ";
        }
      }
    }

		$sql="
      SELECT
        COUNT(*) AS cnt
      FROM
        products pd, categories ca, cattypes ct, units un, brands bd
      WHERE
        $where
        pd.cat_code = ca.code and
        pd.type_code = ct.code and
        pd.unit_code = un.code and
        pd.brand_code = bd.code     
    ";
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
        pd.code, pd.id, pd.name, ct.name AS types, ca.name AS cat, pd.filepic,
        bd.name AS brand, un.name AS units, pd.cost, pd.price, pd.point, pd.quantity
      FROM
        products pd, categories ca, cattypes ct, units un, brands bd
      WHERE
        $where
        pd.cat_code = ca.code and
        pd.type_code = ct.code and
        pd.unit_code = un.code and
        pd.brand_code = bd.code 
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
    
    foreach((array)$tmp as $i => $value){    
      $result['row'][$i]['code']=$value['code'];
      
      $result['row'][$i]['item'][]='<img src="'.URL.'/img/?pic='.$value['filepic'].'&w=30" class="img-rounded" />'; 
      $result['row'][$i]['item'][]=$value['id']; 
      $result['row'][$i]['item'][]=$value['name']; 
      $result['row'][$i]['item'][]=$value['types']; 
      $result['row'][$i]['item'][]=$value['cat']; 
      $result['row'][$i]['item'][]=$value['brand']; 
      $result['row'][$i]['item'][]=NumberDisplay($value['cost']); 
      $result['row'][$i]['item'][]=NumberDisplay($value['price']); 
      $result['row'][$i]['item'][]=NumberDisplay($value['point'], 0); 
      $result['row'][$i]['item'][]=NumberDisplay($value['quantity'], 0);
      $result['row'][$i]['item'][]=$value['units']; 
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

	public function DelPic($code){
    $sql="
      DELETE FROM
        product_pics
      WHERE
        product_code = '$code'
		";
//    echo $sql;
    $query=mysql_query($sql) or die(mysql_error());
	}

	public function LoadPic(){
    $sql="
      SELECT
        *
      FROM
        product_pics
      WHERE
        product_code = '".$this->attr["code"]."'
      ORDER BY
        code DESC
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

  private function LoadCboCatType(){
		$sql="
			SELECT
				code, 
        name
			FROM
				cattypes
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

  private function LoadCboBrand(){
		$sql="
			SELECT
				code, 
        name
			FROM
				brands
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

  private function LoadCboUnit(){
		$sql="
			SELECT
				code, 
        name
			FROM
				units
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
  
  public function LoadCbo(){
    $result['cattype'] = $this->LoadCboCatType();
    $result['brand'] = $this->LoadCboBrand();
    $result['unit'] = $this->LoadCboUnit();
    
    return $result;
  }

  public function LoadCboCat($code){
		$sql="
			SELECT
				code, 
        name
			FROM
				categories
      WHERE
        type_code = '$code'
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
}
?>





























