<?php
/* ==================================================
 *  Author : Tirapant Tongpann
 *  Created Date : 25/12/2553 17:45
 *  Module : Compile
 *  Description : _SEARCH_ _VIEWLIST_ _ADDEDIT_
 *  Involve People : -
 *  Last Updated : 25/12/2553 17:45
  ================================================== */

header("Content-type: text/html; charset=utf-8");
session_start();
require_once "../service/service.php";

function NextCell(&$i=-1){
  $i++;
  $arr[] = 'A';
  $arr[] = 'B';
  $arr[] = 'C';
  $arr[] = 'D';
  $arr[] = 'E';
  $arr[] = 'F';
  $arr[] = 'G';
  $arr[] = 'H';
  $arr[] = 'I';
  $arr[] = 'J';
  $arr[] = 'K';
  $arr[] = 'L';
  $arr[] = 'M';
  $arr[] = 'N';
  $arr[] = 'O';
  $arr[] = 'P';
  $arr[] = 'Q';
  $arr[] = 'R';
  $arr[] = 'S';
  $arr[] = 'T';
  $arr[] = 'U';
  $arr[] = 'V';
  $arr[] = 'W';
  $arr[] = 'X';
  $arr[] = 'Y';
  $arr[] = 'Z';
  
  $arr[] = 'AA';
  $arr[] = 'AB';
  $arr[] = 'AC';
  $arr[] = 'AD';
  $arr[] = 'AE';
  $arr[] = 'AF';
  $arr[] = 'AG';
  $arr[] = 'AH';
  $arr[] = 'AI';
  $arr[] = 'AJ';
  $arr[] = 'AK';
  $arr[] = 'AL';
  $arr[] = 'AM';
  $arr[] = 'AN';
  $arr[] = 'AO';
  $arr[] = 'AP';
  $arr[] = 'AQ';
  $arr[] = 'AR';
  $arr[] = 'AS';
  $arr[] = 'AT';
  $arr[] = 'AU';
  $arr[] = 'AV';
  $arr[] = 'AW';
  $arr[] = 'AX';
  $arr[] = 'AY';
  $arr[] = 'AZ';
  
  $arr[] = 'BA';
  $arr[] = 'BB';
  $arr[] = 'BC';
  $arr[] = 'BD';
  $arr[] = 'BE';
  $arr[] = 'BF';
  $arr[] = 'BG';
  $arr[] = 'BH';
  $arr[] = 'BI';
  $arr[] = 'BJ';
  $arr[] = 'BK';
  $arr[] = 'BL';
  $arr[] = 'BM';
  $arr[] = 'BN';
  $arr[] = 'BO';
  $arr[] = 'BP';
  $arr[] = 'BQ';
  $arr[] = 'BR';
  $arr[] = 'BS';
  $arr[] = 'BT';
  $arr[] = 'BU';
  $arr[] = 'BV';
  $arr[] = 'BW';
  $arr[] = 'BX';
  $arr[] = 'BY';
  $arr[] = 'BZ';
  
  $arr[] = 'CA';
  $arr[] = 'CB';
  $arr[] = 'CC';
  $arr[] = 'CD';
  $arr[] = 'CE';
  $arr[] = 'CF';
  $arr[] = 'CG';
  $arr[] = 'CH';
  $arr[] = 'CI';
  $arr[] = 'CJ';
  $arr[] = 'CK';
  $arr[] = 'CL';
  $arr[] = 'CM';
  $arr[] = 'CN';
  $arr[] = 'CO';
  $arr[] = 'CP';
  $arr[] = 'CQ';
  $arr[] = 'CR';
  $arr[] = 'CS';
  $arr[] = 'CT';
  $arr[] = 'CU';
  $arr[] = 'CV';
  $arr[] = 'CW';
  $arr[] = 'CX';
  $arr[] = 'CY';
  $arr[] = 'CZ';
  
  $arr[] = 'DA';
  $arr[] = 'DB';
  $arr[] = 'DC';
  $arr[] = 'DD';
  $arr[] = 'DE';
  $arr[] = 'DF';
  $arr[] = 'DG';
  $arr[] = 'DH';
  $arr[] = 'DI';
  $arr[] = 'DJ';
  $arr[] = 'DK';
  $arr[] = 'DL';
  $arr[] = 'DM';
  $arr[] = 'DN';
  $arr[] = 'DO';
  $arr[] = 'DP';
  $arr[] = 'DQ';
  $arr[] = 'DR';
  $arr[] = 'DS';
  $arr[] = 'DT';
  $arr[] = 'DU';
  $arr[] = 'DV';
  $arr[] = 'DW';
  $arr[] = 'DX';
  $arr[] = 'DY';
  $arr[] = 'DZ';
  
  $arr[] = 'EA';
  $arr[] = 'EB';
  $arr[] = 'EC';
  $arr[] = 'ED';
  $arr[] = 'EE';
  $arr[] = 'EF';
  $arr[] = 'EG';
  $arr[] = 'EH';
  $arr[] = 'EI';
  $arr[] = 'EJ';
  $arr[] = 'EK';
  $arr[] = 'EL';
  $arr[] = 'EM';
  $arr[] = 'EN';
  $arr[] = 'EO';
  $arr[] = 'EP';
  $arr[] = 'EQ';
  $arr[] = 'ER';
  $arr[] = 'ES';
  $arr[] = 'ET';
  $arr[] = 'EU';
  $arr[] = 'EV';
  $arr[] = 'EW';
  $arr[] = 'EX';
  $arr[] = 'EY';
  $arr[] = 'EZ';  
  
  $arr[] = 'FA';
  $arr[] = 'FB';
  $arr[] = 'FC';
  $arr[] = 'FD';
  $arr[] = 'FE';
  $arr[] = 'FF';
  $arr[] = 'FG';
  $arr[] = 'FH';
  $arr[] = 'FI';
  $arr[] = 'FJ';
  $arr[] = 'FK';
  $arr[] = 'FL';
  $arr[] = 'FM';
  $arr[] = 'FN';
  $arr[] = 'FO';
  $arr[] = 'FP';
  $arr[] = 'FQ';
  $arr[] = 'FR';
  $arr[] = 'FS';
  $arr[] = 'FT';
  $arr[] = 'FU';
  $arr[] = 'FV';
  $arr[] = 'FW';
  $arr[] = 'FX';
  $arr[] = 'FY';
  $arr[] = 'FZ';
  
  $arr[] = 'GA';
  $arr[] = 'GB';
  $arr[] = 'GC';
  $arr[] = 'GD';
  $arr[] = 'GE';
  $arr[] = 'GF';
  $arr[] = 'GG';
  $arr[] = 'GH';
  $arr[] = 'GI';
  $arr[] = 'GJ';
  $arr[] = 'GK';
  $arr[] = 'GL';
  $arr[] = 'GM';
  $arr[] = 'GN';
  $arr[] = 'GO';
  $arr[] = 'GP';
  $arr[] = 'GQ';
  $arr[] = 'GR';
  $arr[] = 'GS';
  $arr[] = 'GT';
  $arr[] = 'GU';
  $arr[] = 'GV';
  $arr[] = 'GW';
  $arr[] = 'GX';
  $arr[] = 'GY';
  $arr[] = 'GZ';
  
  $arr[] = 'HA';
  $arr[] = 'HB';
  $arr[] = 'HC';
  $arr[] = 'HD';
  $arr[] = 'HE';
  $arr[] = 'HF';
  $arr[] = 'HG';
  $arr[] = 'HH';
  $arr[] = 'HI';
  $arr[] = 'HJ';
  $arr[] = 'HK';
  $arr[] = 'HL';
  $arr[] = 'HM';
  $arr[] = 'HN';
  $arr[] = 'HO';
  $arr[] = 'HP';
  $arr[] = 'HQ';
  $arr[] = 'HR';
  $arr[] = 'HS';
  $arr[] = 'HT';
  $arr[] = 'HU';
  $arr[] = 'HV';
  $arr[] = 'HW';
  $arr[] = 'HX';
  $arr[] = 'HY';
  $arr[] = 'HZ';
  
  $arr[] = 'IA';
  $arr[] = 'IB';
  $arr[] = 'IC';
  $arr[] = 'ID';
  $arr[] = 'IE';
  $arr[] = 'IF';
  $arr[] = 'IG';
  $arr[] = 'IH';
  $arr[] = 'II';
  $arr[] = 'IJ';
  $arr[] = 'IK';
  $arr[] = 'IL';
  $arr[] = 'IM';
  $arr[] = 'IN';
  $arr[] = 'IO';
  $arr[] = 'IP';
  $arr[] = 'IQ';
  $arr[] = 'IR';
  $arr[] = 'IS';
  $arr[] = 'IT';
  $arr[] = 'IU';
  $arr[] = 'IV';
  $arr[] = 'IW';
  $arr[] = 'IX';
  $arr[] = 'IY';
  $arr[] = 'IZ';  
  
  return $arr[$i];
}

require_once '../plugin/phpexcel/PHPExcel.php';

//echo "<pre>"; print_r($heal); echo "</pre>";


$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Tirapant Tongpann")
            ->setLastModifiedBy("Tirapant Tongpann")
            ->setTitle("Office 2003 XLS Document")
            ->setSubject("Office 2003 XLS Document")
            ->setDescription("Document for Office 2003 XLS.")
            ->setKeywords("office 2003 openxml php")
            ->setCategory("Result file");

$tittles[] = 'id';
$tittles[] = 'qiz';
$tittles[] = 'ans [1=OK, 0=CANCEL]';


$objPHPExcel->setActiveSheetIndex(0);
$c=-1;
foreach($tittles as $i => $value){
 $cell = NextCell($c)."1";
 $objPHPExcel->getActiveSheet()->SetCellValue($cell, $value);
 $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
}

$n=2;
$string = PHPExcel_Cell_DataType::TYPE_STRING;
$worksheet = $objPHPExcel->getActiveSheet();

$report[] = array('id'=>'1', 'qiz'=>'a', 'ans'=>'');
$report[] = array('id'=>'2', 'qiz'=>'b', 'ans'=>'');
$report[] = array('id'=>'3', 'qiz'=>'c', 'ans'=>'');
foreach($report as $i => $value){ 
  $c = -1;
  $worksheet->getCell(NextCell($c).$n)->setValueExplicit($value['id']);
  $worksheet->getCell(NextCell($c).$n)->setValueExplicit($value['qiz']);
  $worksheet->getCell(NextCell($c).$n)->setValueExplicit($value['ans']);
  $n++;
}

$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
$objPHPExcel->setActiveSheetIndex(0);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$strFileName = "../xls/" . time() . ".xls";
$objWriter->save($strFileName);

@header("location:$strFileName");
?>


































































