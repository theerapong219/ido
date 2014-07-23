<?Php
/*=========================================
*  Author : Tirapant Tongpann
*  Created Date : 28/2/2553 16:56
*  Module : Load Excel to json
*  Description : -
*  Involve People : -
*  Last Updated : 13/11/2013 13:35
=========================================*/
  error_reporting(0);
	header("Content-type: text/html; charset=utf-8");
	ob_start();
	session_start();
  include "../service/service.php";

//  print_r($_FILES);
	if($_FILES['Filedata']['type'] == 'application/octet-stream'){
//    $path="../../xls/excel.xls";
    $path="../xls/excel.xls";
    copy($_FILES['Filedata']['tmp_name'], $path);
    
    require_once '../plugin/excelreader/excel.php';
    require_once '../plugin/excelreader/oleread.php';

    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('utf-8');
    $data->read($path);

    error_reporting(E_ALL ^ E_NOTICE);
    
//    print_r($data->sheets[0]['cells']);
    $record = (array) $data->sheets[0]['cells'];
    $result['success'] = 'COMPLETE';
    $result['topic']=(array)$record[1];
    unset($record[1]);

    foreach($result['topic'] as $i => $value){
      $tmp[$i] = '';
    }
    $cnttopic = count($cnttopic);
    $n = 1;
    foreach ((array) $record as $i => $row) {
      if(count($row) == $cnttopic){
        $result['record'][$n] = (array)$row;
      }else{
        $result['record'][$n] = $tmp; 
        foreach((array)$row as $j => $value){
          $result['record'][$n][$j] = $value;
        }
      }
      $n++;
    }
  }else{
    $result['success'] = 'FAIL';
	}
  unset($attr);
  mysql_close();
  
  echo json_encode($result);
?>