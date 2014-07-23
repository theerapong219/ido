<?php 
header("Content-type: text/html; charset=utf-8");
//error_reporting('E_NOTICE');
//error_reporting('E_ALL'); 
session_start();

function LoadPrint(){
  global $attr;
  $sql="
    select 
      *
    from
      quotations
    where
      code = '{$attr['code']}'
  ;";
//	echo "<pre>$sql</pre>";
  $query=mysql_query($sql);
  $result = array();
  if($row=mysql_fetch_assoc($query)){
    $result = $row;
  }
  mysql_free_result($query);

  return $result;
}

require_once '../../../service/service.php';
$attr = $_GET;
$datenow = DateNow();
$print = LoadPrint();
//echo "<pre>"; print_r($print); echo "</pre>";
//exit;

require_once "../../../plugin/mpdf/mpdf.php";

$mpdf = new mPDF('utf-8',    // mode - default ''
 'A4',    // format - A4, for example, default ''
 10,     // font size - default 0
 'Tahoma',    // default font family
 15,    // margin_left
 10,    // margin right
 10,    // margin top
 10,    // margin bottom
 9,     // margin header
 9,     // margin footer
 'P');  // L - landscape, P - portrait
$mpdf->SetAutoFont();

/**************************************\
 * HEADER
\**************************************/
$mpdf->defaultheaderfontsize = 10; /* in pts */
$mpdf->defaultheaderfontstyle = 'B'; /* blank, B, I, or BI */
$mpdf->defaultheaderline = 2; /* 1 to include line below header/above footer */

/**************************************\
 * STYLE
\**************************************/
$style = '
<style>
.block{border:solid black; border-width:1px 1px 0 1px;}
.data{padding:5px 10px 0 10px;}
</style>
';
$mpdf->WriteHTML($style);

/**************************************\
 * REPORT
\**************************************/
$html = '
<table cellpadding="10" cellspacing="0" width="100%">
  <tr>
    <td style="width:80%">
      <h3>QA International Certification Limited</h3><br/>
      <h2 style="text-align:center;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; APPLICATION FOR ASSESSMENT</h2>
    </td>
    <td>
    	<div style="text-align:right; width:100px; float:right;"> img</div>
    </td>
  </tr>
</table>

<div class="block">
	<div class="data">Company Name(ภาษาอังกฤษ) : '.$print['customer_en'].'</div>
	<div class="data">ชื่อบริษัท(ภาษาไทย) : '.$print['contact_th'].'</div>
</div>

<div class="block">
	<div class="data">Head Office Address(ภาษาอังกฤษ) : '.$print['address_en'].'</div>
	<div class="data">สำนักงานใหญ่(ภาษาไทย) : '.$print['address_th'].'</div>
</div>

<div class="block">
  <table cellpadding="10" cellspacing="0" width="100%">
    <tr>
      <td width="50%">
        <div class="data">No. of Employees (Total) : '.$print[''].' Persons</div>
      </td>
      <td width="50%">
        <div class="data">(จำนวนพนักงานทั้งหมด) : '.$print[''].' คน</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="data">(จำนวนพนักงานทั้งหมด) : '.$print[''].' site</div>
      </td>
      <td>
        <div class="data">ต่อพื้นที่ : '.$print[''].' พื้นที่</div>
      </td>
    </tr>
  </table>
</div>

<div class="block">
	<div class="data">Location of all sites/locations relative to the Scope of Certification for assessment (ภาษาอังกฤษ) : '.$print[''].'</div>
</div>

<div class="block">
  <table cellpadding="10" cellspacing="0" width="100%">
    <tr>
      <td width="50%">
        <div class="data">Contact name (ภาษาอังกฤษ) : '.$print['contact_en'].'</div>
      </td>
      <td rowspan="2" width="50%">
        <div class="data">'.$print[''].'</div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="data">Position (ภาษาอังกฤษ) : '.$print[''].'</div>
      </td>
    </tr>
  </table>
</div>

<div class="block">
  <table cellpadding="10" cellspacing="0" width="100%">
    <tr>
      <td width="50%">
        <div class="data">ชื่อผู้ติดต่อ (ภาษาไทย) : '.$print['contact_th'].'</div>
      </td>
      <td width="50%">
        <div class="data">ตำแหน่ง (ภาษาไทย) : '.$print[''].'</div>
      </td>
    </tr>
  </table>
</div>

<div class="block">
  <table cellpadding="10" cellspacing="0" width="100%">
    <tr>
      <td width="20%">
        <div class="data">Telephone No :<br/>'.$print['tel'].'</div>
      </td>
      <td width="20%">
        <div class="data">Fax No :<br/>'.$print['fax'].'</div>
      </td>
      <td width="30%">
        <div class="data">Email :<br/>'.$print[''].'</div>
      </td>
      <td width="30%">
        <div class="data">Website :<br/>'.$print['website'].'</div>
      </td>
    </tr>
  </table>
</div>

<div class="block">
	<div class="data">Assessment Standard against which registration is sought : '.$print[''].'</div>
</div>

<div class="block" style="border-bottom:1px solid black;">
	<div class="data">Scope of certification/registration (ภาษาอังกฤษ) : '.$print['scope_en'].'</div>
	<div class="data">ขอบเขตขอการรับรอง (ภาษาไทย) : '.$print['scope_th'].'</div>
	<div class="data">I wish to apply for registration of our Company under the above Standard and Scope of Registration further to your quotation reference. QAIC/TH/520210</div>
  <h3>&nbsp; DECLARATION</h3>
	<div class="data" style="text-align:justify">In making this application we agree to be bound by the Rules and Regulations pertaining to QA International and such additional conditions as The Governing Board of the Scheme may from time to time deem necessary and appropriate. To entry of the Company on the QA International Certification website. <br/>
  N.B. When requested and with your consent; confidential information may be viewed by a third party or UKAS for Accreditation renewal purposes (see Scheme Regulations)</div>
	<div class="data">Name :<u>&nbsp;&nbsp;'.$print[''].'&nbsp;&nbsp;</u> Position:<u>&nbsp;&nbsp;'.$print[''].'&nbsp;&nbsp;</u></div>
	<div class="data">Signature :<u>&nbsp;&nbsp;'.$print[''].'&nbsp;&nbsp;</u> Date:<u>&nbsp;&nbsp;'.$print[''].'&nbsp;&nbsp;</u></div>
	<div class="data">From time to time it may be necessary to use contract assessment staff. Please tick if you would require prior notification of this [ &nbsp; ].</div>
</div>

<h3>&nbsp; &nbsp; &nbsp; Unless otherwise instructed please send your manual(s) and any supporting procedure(s) with your application.</h3>

<br/>
<div style="text-align:right">Issue 4: 18/06/08</div>
';
$mpdf->WriteHTML($html);


$mpdf->Output();

exit;
?>

