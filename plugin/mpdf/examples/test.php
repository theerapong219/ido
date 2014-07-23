<?
$hostname = "localhost"; //ชื่อ โฮส
$user = "root"; //ชื่อยูเซอร์ในการติดต่อฐานข้อมูล
$password = "4611559"; //พาสเวิร์ดในการเชื่อมต่อฐานข้อมูล
$dbname = "meeting"; //ชื่อฐานข้อมูล
$connection=mysql_connect($hostname, $user, $password) or die("ไม่สามารถติดต่อฐานข้อมูลได้");

mysql_query("SET NAMES tis620",$connection);

//$sql="select startday,endday from meeting_day";
mysql_select_db($dbname,$connection) or die ("Error database connect");
//$result=mysql_fetch_array($dbquery);

//$config_day=$result[0];
?>

<?php

$html_1 = '
<html>
<head>
<meta charset=utf-8 />
<h1>กกกกกกกก<a name=top></a>mPDF</h1>
<h2>Basic HTML Example</h2>
';

$rs=mysql_query('SELECT
meeting_user.user_id,
meeting_user.username,
meeting_user.passwords,
meeting_user.`name`,
meeting_user.email,
meeting_user.phone,
meeting_user.address,
meeting_user.staus
FROM
meeting_user
ORDER BY
meeting_user.user_id ASC'); //  ASC  เรียงลำดับ

$b = "aaaa";

$html_2 = '<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>ชื่อเข้าสู่ระบบ</td>
    <td>รหัสผ่าน</td>
    <td>ชื่อ</td>
    <td>อีเมล์</td>
    <td>เบอร์โทร</td>
	
  </tr></tr>
  
  '; 
  while($kk=mysql_fetch_array($rs)) {
  
  $username = $kk['username'];
  $passwords = $kk['passwords'];
  $name = $kk['name'];
  $email = $kk['email'];
  $phone = $kk['phone'];
    
  $html_2.='<tr><td>'.$username.'</td><td>'.$passwords.'</td><td>'.$name.'</td><td>'.$email.'</td><td>'.$phone.'</td></tr>';
  
}
  $html_2.='</table>';
	

include("../mpdf.php");

$mpdf=new mPDF(); 

$mpdf->SetAutoFont();
$mpdf->WriteHTML($html_2);


$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>

