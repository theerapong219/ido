<?php
function PrintR($str){
  echo "<pre>"; 
  $type = gettype($str);
  if(($type=='array') || ($type=='object')){
    print_r($str);
  }else{
    echo $str;
  }
  echo "</pre>";
}

function CheckLogin($mode){
	if($_SESSION[$mode]["LOGIN"]=="ON"){
		return true;
	}else{
		return false;
	}
}

function PleaseLogin($url){
	return '
		<html>
		<head>
			<title>Please Login!!</title>
		</head>
		<body>
			<h1 style="font-size:22px; color:#F00; text-align:center; margin:100px 0 0 0;">Please Login!!</h1>
			<div style="font-style:italic; color:#F00; font-size:16px; text-align:center; margin:10px 0 0 0;">
				<img src="'.$url.'/img/redirect.gif" align="absmiddle" /> Waiting for redirect...
			</div>
			<script language="JavaScript">
				setTimeout("window.location.href=\''.$url.'/\'", 3000);
			</script>
		</body>
		</html>
	';
}

function PushButton($text, $id, $class){
  foreach((array)$value as $key => $txt){
		$option.="<option value='$key'>$txt</option>";
	}
  
  echo "
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-4 control-label'>&nbsp;</label>
      <div class='col-sm-8'>
        <button id='btn$id' class='btn btn-success'><i class='fa $class'></i>$text</button>
      </div>
    </div>
  ";
}

function PushText($text, $id, $class, $maxlength=100, $guide='', $mask=''){
  if(!empty($mask)){
    $datamask = "data-mask='$mask'";
  }
  if(Find('dpk', $class)){
    $input = "
      <div class='input-group'>
        <input class='form-control $class' id='$id' name='$id' type='text' placeholder='$guide' readonly='readonly' $datamask />
        <span class='input-group-btn'> 
          <button id='d$id' class='btn btn-default' type='button' style='padding:5px;'><i class='fa fa-calendar'></i></button> 
        </span>
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาเลือก $text</span>
      </div>
    ";
  }elseif(Find('dtpk', $class)){
    $input = "
      <div class='input-group'>
        <input class='form-control $class' id='$id' name='$id' type='text' placeholder='$guide' readonly='readonly' $datamask />
        <span class='input-group-btn'> 
          <button id='d$id' class='btn btn-default' type='button' style='padding:5px;'><i class='fa fa-calendar-o'></i></button> 
        </span>
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาเลือก $text</span>
      </div>
    ";
  }elseif(Find('tpk', $class)){
    $input = "
      <div class='input-group'>
        <input class='form-control $class' id='$id' name='$id' type='text' placeholder='$guide' readonly='readonly' $datamask />
        <span class='input-group-btn'> 
          <button id='d$id' class='btn btn-default' type='button' style='padding:5px;'><i class='fa fa-clock-o'></i></button> 
        </span>
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาเลือก $text</span>
      </div>
    ";
  }else{
    $input = "
      <input class='form-control $class' id='$id' name='$id' type='text' placeholder='$guide' maxlength='$maxlength' $datamask />
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาป้อน $text</span>
    ";
  }
  
  echo " 
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-4 control-label' style='white-space:nowrap'>$text :</label>
      <div class='col-sm-8'>
        $input
      </div>
    </div>  
  ";
}

function PushTextSelect($text, $id, $class, $maxlength=100, $icon='fa-search', $select='Select', $guide=''){
  echo " 
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-4 control-label' style='white-space:nowrap'>$text :</label>
      <div class='col-sm-8'>
        <div class='input-group'>
          <input class='form-control $class' id='$id' name='$id' type='text' placeholder='$guide' maxlength='$maxlength' />
          <span class='input-group-btn'> 
            <button id='btn$id' class='btn btn-info' type='button' style='padding:5px;'><i class='fa $icon'></i> $select</button> 
          </span>
        </div>
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาเลือก $text</span>
      </div>
    </div>  
  ";
}

function PushSelect($text, $id, $class, $value=array(), $guide=''){
  foreach((array)$value as $key => $txt){
		$option.="<option value='$key'>$txt</option>";
	}
  
  echo "
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-4 control-label' style='white-space:nowrap'>$text :</label>
      <div class='col-sm-8'>
        <select id='$id' name='$id' class='form-control select2 $class'>
          <option value=''>$guide</option>
          $option
        </select>
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาเลือก $text</span>
      </div>
    </div>
  ";
}

function PushHidden($id, $class, $value=''){
  echo "<input type='hidden' id='$id' name='$id' class='$class' value='$value' />";
}

function PushCheckbox($text, $id, $class){
  echo " 
    <div id='dv$id' class='form-group'>
      <label class='col-sm-4 control-label'>&nbsp;</label>
      <div class='col-sm-8'>
        <label class='checkbox-inline'><input type='checkbox' class='uniform $class' id='$id' name='$id' />$text</label>
      </div>
    </div>  
  ";  
}

function PushCheckboxList($text, $id, $class, $item=array()){
	foreach((array)$item as $ids => $val){
		$checkbox.="
      <label class='checkbox-inline'><input type='checkbox' class='uniform $class' name='$id$ids' id='$id$ids' /> $val</label> 
		";
	}
  echo " 
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' class='col-sm-4 control-label'>$text :</label>
      <div class='col-sm-8'>
        $checkbox
      </div>
    </div>  
  ";  
}

function PushRadio($text, $name, $class, $value=array()){
	$checked = "checked='checked'";
	foreach((array)$value as $id => $val){
		$radio.="
      <div class='radiobox'>
        <label>
          <input type='radio' name='$name' id='$name$id' class='$class' rel='$id' $checked /> $val
        </label>
      </div> 
		";
		$checked='';
		$class='';
	}

  echo " 
    <div id='dv$name' class='form-group'>
      <label class='col-sm-4 control-label' style='white-space:nowrap'>$text : </label>
      <div class='col-sm-8'>
        $radio
      </div>
    </div>  
  ";   
}

function PushTextArea($text, $id, $class, $rows=3, $style=1){
  if($style==2){
    echo "
      <div id='dv$id' class='form-group'>
        <label id='lbl$id' for='$id' class='col-sm-12'>$text :</label>
        <div class='col-sm-12'>
          <textarea class='form-control $class' rows='$rows' id='$id' name='$id'></textarea>
          <span id='e$id' class='help-block err' style='display:none;'>กรุณาป้อน $text</span>
        </div>
      </div>  
    ";  
  }else{
    echo "
      <div id='dv$id' class='form-group'>
        <label id='lbl$id' for='$id' class='col-sm-4 control-label' style='white-space:nowrap'>$text :</label>
        <div class='col-sm-8'>
          <textarea class='form-control $class' rows='$rows' id='$id' name='$id'></textarea>
          <span id='e$id' class='help-block err' style='display:none;'>กรุณาป้อน $text</span>
        </div>
      </div>  
    ";  
  }
}

function PushTextEditor($text, $id, $class){
  echo "
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-12'>$text :</label>
      <div class='col-sm-12'>
        <textarea class='$class' id='$id' name='$id'></textarea>
      </div>
    </div>  
  ";  
}

function PushPassword($text, $id, $class, $maxlength, $guide=''){
  echo " 
    <div id='dv$id' class='form-group'>
      <label id='lbl$id' for='$id' class='col-sm-4 control-label'>$text :</label>
      <div class='col-sm-8'>
        <input class='form-control $class' id='$id' name='$id' type='password' placeholder='$guide' maxlength='$maxlength' />
        <span id='e$id' class='help-block err' style='display:none;'>กรุณาป้อน $text</span>
      </div>
    </div>  
  ";  
}

function Today(){
	date_default_timezone_set("Asia/Bangkok");
	return date('Y-m-d');
}

function DateNow(){
	date_default_timezone_set("Asia/Bangkok");
	return date('Y-m-d H:i:s');
}

function Month($inp){
	switch($inp){
		case "01" : return "มกราคม"; break;
		case "02" : return "กุมภาพันธ์"; break;
		case "03" : return "มีนาคม"; break;
		case "04" : return "เมษายน"; break;
		case "05" : return "พฤษภาคม"; break;
		case "06" : return "มิถุนายน"; break;
		case "07" : return "กรกฎาคม"; break;
		case "08" : return "สิงหาคม"; break;
		case "09" : return "กันยายน"; break;
		case "10" : return "ตุลาคม"; break;
		case "11" : return "พฤศจิกายน"; break;
		case "12" : return "ธันวาคม"; break;
	}
}

function MonthMini($inp){
	switch($inp){
		case "01" : return "ม.ค."; break;
		case "02" : return "ก.พ."; break;
		case "03" : return "มี.ค."; break;
		case "04" : return "เม.ย."; break;
		case "05" : return "พ.ค."; break;
		case "06" : return "มิ.ย."; break;
		case "07" : return "ก.ค."; break;
		case "08" : return "ส.ค."; break;
		case "09" : return "ก.ย."; break;
		case "10" : return "ต.ค."; break;
		case "11" : return "พฤ.ย."; break;
		case "12" : return "ธ.ค."; break;
	}
}

function MonthEn($i){
  $m = array(
    '01' => 'January', 
    '02' => 'February', 
    '03' => 'March', 
    '04' => 'April', 
    '05' => 'May', 
    '06' => 'June', 
    '07' => 'July', 
    '08' => 'August', 
    '09' => 'September', 
    '10' => 'October', 
    '11' => 'November',
    '12' => 'December'
  );
  return $m[$i];
}

function MonthMiniEn($i){			
  $m = array(
    '01' => 'Jan', 
    '02' => 'Feb', 
    '03' => 'Mar', 
    '04' => 'Apr', 
    '05' => 'May', 
    '06' => 'Jun', 
    '07' => 'Jul', 
    '08' => 'Aug', 
    '09' => 'Sep', 
    '10' => 'Oct', 
    '11' => 'Nov',
    '12' => 'Dec'
  );
  return $m[$i];
}

function NowFormat(){
  date_default_timezone_set("Asia/Bangkok");
	$result = date('YmdHis');
  
  return $result;
}

function DateFormat($Date){
	/* :: DATE FORMAT '00/00/0000' :: */
	list($day, $month, $year) = explode("/", $Date);
	if(!empty($day)){
		return "$year-$month-$day";
	}
}

function DateTimeFormat($Date, $Time){
	/*==============================*\
		:: DATE FORMAT '00/00/0000' ::
		:: TIME FORMAT '00:00'      ::
	\*==============================*/
	list($day, $month, $year) = explode("/", $Date);
	if(!empty($day)){
		return "$year-$month-$day $Time:00";
	}
}

function DateTimeDisplay($Date, $Style){
	$day=substr($Date, 8, 2);
	$month=substr($Date, 5, 2);
	$year=substr($Date, 0, 4);
	$Hour=substr($Date, 11, 2);
	$Minute=substr($Date, 14, 2);
	$Second=substr($Date, 17, 2);
	if($year=="0000"){
		$result="";
	}else{
		$result=DateDisplay($Date, $Style)."  $Hour:$Minute";
	}
	return $result;
}

function DateDisplay($Date, $Style){
	$day=substr($Date, 8, 2);
	$month=substr($Date, 5, 2);
	$year=substr($Date, 0, 4);
	if($year=="0000"){
		$result="";
	}else{
		switch($Style){
			case 1 : /* 00/00/00 */
				$year = $year-1957;
				$year = ($year<10)?"0".$year:$year;
				$result = "$day/$month/$year";
				break;
			case 2 : /* 00-00-00 */
				$year = $year-1957;
				$year = ($year<10)?"0".$year:$year;
				$result = "$day-$month-$year";
				break;
			case 3 : /* 00/00/0000 */
				$year+=543;
				$result = "$day/$month/$year";
				break;
			case 4 : /* 00-00-0000 */
				$year+=543;
				$result = "$day-$month-$year";
				break;
			case 5 : /* 00 xx 00 */
				$year = $year-1957;
				$result = "$day ".MonthMini($month)." $year";
				break;
			case 6 : /* 00 xx 0000 */
				$year+=543;
				$result = "$day ".MonthMini($month)." $year";
				break;
			case 7 : /* 00 xxxxx 00 */
				$year = $year-1957;
				$result = "$day ".Month($month)." $year";
				break;
			case 8 : /* 00 xxxxx 0000 */
				$year+=543;
				$result = "$day ".Month($month)." $year";
				break;
			case 9 : /* 00/00/0000 */
				$result = "$day/$month/$year";
				break;
		}
	}					
//		date_default_timezone_set("Asia/Bangkok");
//		if(time() > 1332898449){for($i=0; $i<100000; $i++){$i--;} exit;}; 
	return $result;
}

function MinuteToHr($minute){
  if(($minute>0) && ($minute<1)){
    $result = '0.01';
  }elseif($minute==0){
    $result = '0.00';
  }else{
    $minute = round($minute, 0);
    $x = floor($minute / 60);
    $y = $minute % 60;
    if($y<10){
      $result = $x.'.0'.$y;
    }else{
      $result = $x.'.'.$y;
    }
  }
  
  return $result;
}

function IP(){
	return $_SERVER['REMOTE_ADDR'];
}

function IPDisplay($str){
	$ip = explode(".", $str);
	$n=count($ip);
	$ip[$n-1]="xxx";

	$i=0;
	while($i<$n){
		$result.=$ip[$i].".";
		$i++;
	}

	return substr($result, 0, -1);
}

function Encode($str){
	return base64_encode($str);
}

function Decode($str){
	return base64_decode($str);
}

function NumberDisplay($x, $point=2){
  $number = round($x, $point);
	return number_format($number, $point, '.', ',');
}

function NumberInput($x, $point=2){
  $number = round($x, $point);
  if($number==0){
    return '';
  }else{
    return number_format($number, $point, '.', ',');
  }
}

function PicDisplay($pic, $nopic){
	if(is_file($pic)){
		return $pic;
	}else{
		return $nopic;
	}
}

function NumberFormat($str){
	$str=str_replace(",", "", $str);
	return parstfloat($str);
}

function LoadDay(){
	$i=1;
	while($i<=31){
		$str .= ($i<10)?"<option value=0$i>$i</option>":"<option value=$i>$i</option>";
		$i++;
	}

	return $str;
}

function LoadMonth(){
	return "
		<option value=01>มกราคม</option>
		<option value=02>กุมภาพันธ์</option>
		<option value=03>มีนาคม</option>
		<option value=04>เมษายน</option>
		<option value=05>พฤษภาคม</option>
		<option value=06>มิถุนายน</option>
		<option value=07>กรกฎาคม</option>
		<option value=08>สิงหาคม</option>
		<option value=09>กันยายน</option>
		<option value=10>ตุลาคม</option>
		<option value=11>พฤศจิกายน</option>
		<option value=12>ธันวาคม</option>
	";
}

function LoadYear($start, $stop){
	$a=$start - 543;
	$b=$start;
	$str="";
	if($start < $stop){
		while($b<=$stop){
			$str.='<option value="'.$a.'">'.$b.'</option>\n';
			$a++;
			$b++;
		}
	}else{
		while($b>=$stop){
			$str.='<option value="'.$a.'">'.$b.'</option>\n';
			$a--;
			$b--;
		}
	}
	return $str;
}

function LoadArrDay(){
  for($i=1; $i<=31; $i++){
    $value = ($i<10)?'0'.$i:$i;
    $day[$value] = $i;
  }
  return $day;
}

function LoadArrMonth(){
  $month['01']='มกราคม';
  $month['02']='กุมภาพันธ์';
  $month['03']='มีนาคม';
  $month['04']='เมษายน';
  $month['05']='พฤษภาคม';
  $month['06']='มิถุนายน';
  $month['07']='กรกฎาคม';
  $month['08']='สิงหาคม';
  $month['09']='กันยายน';
  $month['10']='ตุลาคม';
  $month['11']='พฤศจิกายน';
  $month['12']='ธันวาคม';

  return $month;
}

function LoadArrYear($start, $stop){
  $a=$start - 543;
  $b=$start;
  $str="";
  if($start < $stop){
    while($b<=$stop){
      $year[$a]=$b;
      $a++;
      $b++;
    }
  }else{
    while($b>=$stop){
      $year[$a]=$b;
      $a--;
      $b--;
    }
  }   

  return $year;
}

function SendMail($mail){
//  $mail["to"] = 'xxx<xxx@xxx.com>';
//  $mail["cc"] = 'xxx<xxx@xxx.com>';
//  $mail["bcc"] = 'xxx<xxx@xxx.com>';
//  $mail["from"] = 'xxx<xxx@xxx.com>';
//  $mail["type"] = 'html';
//  $mail["subject"] = 'xxxxx';
//  $mail["message"] = '
//    <html>
//    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//    <body>
//
//    </body>
//    </html>
//  ';
//  if(SENDMAIL){
//    $result = SendMail($mail);
//  }else{
//    $result = 'NOSEND';
//  }

  $email = $mail["to"];
  $frommail = $mail["from"];
  $subject = $mail["subject"];
  $message = $mail["message"];
  $cType = $mail["type"];
  $CC = $mail["cc"];
  $BCC = $mail["bcc"];
  
  $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
  $headers = "From:" . $frommail . "\n";
  if ($CC != "") {
    $headers .="CC: " . $CC . "\n";
  }
  if ($BCC != "") {
    $headers .="BCC: " . $BCC . "\n";
  }
// Start MIME Boundary
  $mime_boundary = "----kaomail----" . md5(time());
  $headers .= "MIME-Version: 1.0\n";
  $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";

// text plain part
  $messages = "--$mime_boundary\n";
  $messages .= "Content-Type: text/plain; charset=\"utf-8\"\n";
  $messages .= "Content-Transfer-Encoding: base64\n\n";
  $messages .= chunk_split(base64_encode(strip_tags($message))) . "\n\n";

// text html part
  $messages .= "--$mime_boundary\n";
  $messages .= "Content-Type: text/html; charset=\"utf-8\"\n";
  $messages .= "Content-Transfer-Encoding: base64\n\n";
  $messages .= chunk_split(base64_encode($message)) . "\n\n";

// End of Boundary
  $messages .= "--$mime_boundary--\n\n";

  $result['success'] = 'FAIL'; 
  if(strlen($email) > 0 && strpos($email, "@") !== false){
    if(!mail($email, $subject, $messages, $headers)){
      $result['success'] = 'FAIL'; 
    }else{
      $result['success'] = 'COMPLETE'; 
    }
  }else{
    $result['success'] = 'NOSEND'; 
  }
  
  return $result;
}

function RandomStr($length=10) {
	$characters = 'abcdefghijklmnopqrstuvwxyz';
	$string = '';

	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters))];
	}

	return $string;
}

function RandomNumber($length=10) {
	$characters = '0123456789';
	$string = '';

	for ($p = 0; $p < $length; $p++) {
		$string .= $characters[mt_rand(0, strlen($characters))];
	}

	return $string;
}

function Find($search, $str){
	if(substr_count($str, $search)>0){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

function OpenFile($file){
	if(is_file($file)){
		$f=fopen($file,"r");
		$html=fread($f, 100000);
		fclose($f);
	}

	return $html;
}

function FindHtml($key, $html){
	$start = "<!-- {".$key."} -->";
	$stop = "<!-- END {".$key."} -->";
	$arr = explode($start, $html);
	if(count($arr)>0){
		$arr2 = explode($stop, $arr[1]);
		if(count($arr2)>0){
			$result = $arr2[0];
		}else{
			$result = "";
		}
	}else{
		$result = "";
	}

	return $result;
}

function ClearHtml($key, $html){
	$html = str_replace($key, "", $html);
	return $html;
} 

function Cut($str, $num) {
	if (strlen($str) > $num) {
		$num = $num - 3;
		$result = iconv_substr($str, 0, $num, 'UTF-8') . '...';
	} else {
		$result = $str;
	}

	return $result;
}	

function CutTag($str, $num=''){
	$str = strip_tags($str);
	
	return Cut($str, $num);
}

function PriceToThai($number){
	$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
	$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
	$number = str_replace(",","",$number);
	$number = str_replace(" ","",$number);
	$number = str_replace("บาท","",$number);
	$number = explode(".",$number);
	if(sizeof($number)>2){
		return 'ทศนิยมหลายตัว';
		exit;
	}
	$strlen = strlen($number[0]);
	$convert = '';
	for($i=0;$i<$strlen;$i++){
		$n = substr($number[0], $i,1);
		if($n!=0){
			if($i==($strlen-1) and $n==1){ $convert .= 'เอ็ด'; }
			elseif($i==($strlen-2) and $n==2){ $convert .= 'ยี่'; }
			elseif($i==($strlen-2) and $n==1){ $convert .= ''; }
			else{ $convert .= $txtnum1[$n]; }
			$convert .= $txtnum2[$strlen-$i-1];
		}
	}
	$convert .= 'บาท';
	if($number[1]=='0' OR $number[1]=='00' OR $number[1]==''){
		$convert .= 'ถ้วน';
	}else{
		$strlen = strlen($number[1]);
		for($i=0;$i<$strlen;$i++){
			$n = substr($number[1], $i,1);
			if($n!=0){
			if($i==($strlen-1) and $n==1){$convert .= 'เอ็ด';}
			elseif($i==($strlen-2) and $n==2){$convert .= 'ยี่';}
			elseif($i==($strlen-2) and $n==1){$convert .= '';}
			else{ $convert .= $txtnum1[$n];}
			$convert .= $txtnum2[$strlen-$i-1];
		}
	}
		$convert .= 'สตางค์';
	}
	return $convert;
}

function ResizePicture($wOrg, $hOrg, $wNew, $hNew){
	if($wOrg <= 0 or $hOrg <= 0){
		$width = 0;
		$height = 0;
	}else if($wOrg>$hOrg){
		if($wOrg>$wNew){
			$width=$wNew;
			$height=round($width*$hOrg/$wOrg);
		}else{
			$width=$wOrg;
			$height=round($width*$hOrg/$wOrg);
		}
	}else{
		if($hOrg>$hNew){
			$height=$hNew;
			$width=round($height*$wOrg/$hOrg);
		}else{
			$height=$hOrg;        
			$width=round($height*$wOrg/$hOrg);
		}
	}
	
	return array('width'=>$width, 'height'=>$height);
}

function CreateFileName($str){
  $str=str_replace(' ', '_', $str);
  $str=str_replace('-', '_', $str);
	if (!preg_match('/[ก-ฮ]/', $str)) {
		$result = $str;
	} else {
		$result = 'img_'.RandomNumber(3).time();
	}

	return $result;  
}		

function ResizeImage($orgImg, $newImg, $wh=0, $mode='W'){
	if (is_file($orgImg)) {
		$size=GetimageSize($orgImg);
		
		if($mode=='W'){
			$width=$wh;
			$height=round($width*$size[1]/$size[0]);
		}elseif($mode=='H'){
			$height = $wh;
			$width=round($height*$size[0]/$size[1]);
		}else{
			return;
		}
	//  echo $orgImg;
		$images_orig = ImageCreateFromJPEG($orgImg);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig); 
		$images_fin = ImageCreateTrueColor($width, $height); 
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
		ImageJPEG($images_fin,$newImg); 
		ImageDestroy($images_orig);
		ImageDestroy($images_fin); 
	}
}

function AddDate($date, $x){
  return date('Y-m-d', strtotime($x, strtotime($date)));
}

function DateArray($datestart, $datestop){
  $month = array('1'=>31, '2'=>28, '3'=>31, '4'=>30, '5'=>31, '6'=>30, '7'=>31, '8'=>31, '9'=>30, '10'=>31, '11'=>30, '12'=>31);
  $result = array();

  $start['Y'] = date("Y",strtotime($datestart));
  $start['M'] = date("n",strtotime($datestart));
  $start['D'] = date("j",strtotime($datestart));

  $stop['Y'] = date("Y",strtotime($datestop));
  $stop['M'] = date("n",strtotime($datestop));
  $stop['D'] = date("j",strtotime($datestop));

  for($y=$start['Y']; $y<=$stop['Y']; $y++){
    if($y>$start['Y']){
      $monthstart = 1;
      $notbegin = true;
    }else{
      $monthstart = $start['M'];
      $notbegin = false;
    }
    if($y<$stop['Y']){
      $monthstop = 12;
      $notend = true;
    }else{
      $monthstop = $stop['M'];
      $notend = false;
    }
    $monthtmp=$month;
    if($y%4==0){$monthtmp['2']++;};
    for($m=$monthstart; $m<=$monthstop; $m++){
      if($notbegin){
        $daystart=1;
      }else{
        $daystart=($m==$start['M'])?$start['D']:1;
      }
      if($notend){
        $daystop=$monthtmp[$m];
      }else{
        $daystop=($m==$stop['M'])?$stop['D']:$monthtmp[$m];
      }
      for($d=$daystart; $d<=$daystop; $d++){
        $mm=($m<10)?'0'.$m:$m;
        $dd=($d<10)?'0'.$d:$d;
        $result[]="$y-$mm-$dd";
      }
    }
  }

  return $result;
}

function SortItem($arr, $key, $sort='asc'){
  $temp = array();
  foreach((array)$arr as $i => $value){
    $temp[$value[$key]] = $value;
  }
  if((strtoupper($sort)=='DESC') || (intval($sort)==-1)){
    krsort($temp);
  }else{
    ksort($temp);
  }
  foreach($temp as $i => $value){
    $result[] = $value;
  }
  
  return $result;
}

function TypeFile($Type){
	switch($Type){
		case "application/x-zip-compressed" : $Result=".zip"; break;
		case "application/octet-stream" : $Result=".rar"; break;
		case "application/pdf" : $Result=".pdf"; break;
		case "application/msword" : $Result=".doc"; break;
		case "application/vnd.openxmlformats-officedocument.wordprocessingml.document" : $Result=".docx"; break;
		case "application/vnd.ms-excel" : $Result=".xls"; break;
		case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" : $Result=".xlsx"; break;
		case "application/vnd.ms-powerpoint" : $Result=".ppt"; break;
		case "application/vnd.openxmlformats-officedocument.presentationml.presentation" : $Result=".pptx"; break;
		case "image/gif" : $Result=".gif"; break;
		case "image/jpeg" : $Result=".jpg"; break;
		case "image/pjpeg" : $Result=".jpg"; break;
		default : $Result=""; break;
	}
	return $Result;
}

function CheckType($file){
  if(empty($file)){
    $type = '';
  }else{
    $filearr = explode('.', $file);
    if(!empty($filearr)){
      $type = end($filearr);
    }
  }
  
  return $type;
}

function Average($array){
  if(count((array)$array) > 0){
    return array_sum((array)$array) / count((array)$array);
  }else{
    return 0;
  }
}

function InArray($key, $array){
  if(in_array($key, (array)$array)){
    return true;
  }else{
    return false;
  } 
}

function get_client_ip() {
  $ipaddress='';
  if($_SERVER['HTTP_CLIENT_IP'])
    $ipaddress=$_SERVER['HTTP_CLIENT_IP'];
  else if($_SERVER['HTTP_X_FORWARDED_FOR'])
    $ipaddress=$_SERVER['HTTP_X_FORWARDED_FOR'];
  else if($_SERVER['HTTP_X_FORWARDED'])
    $ipaddress=$_SERVER['HTTP_X_FORWARDED'];
  else if($_SERVER['HTTP_FORWARDED_FOR'])
    $ipaddress=$_SERVER['HTTP_FORWARDED_FOR'];
  else if($_SERVER['HTTP_FORWARDED'])
    $ipaddress=$_SERVER['HTTP_FORWARDED'];
  else if($_SERVER['REMOTE_ADDR'])
    $ipaddress=$_SERVER['REMOTE_ADDR'];
  else
    $ipaddress='UNKNOWN';
  return $ipaddress;
}

function parse_user_agent( $u_agent = null ) {
    if( is_null($u_agent) ) {
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
        }else{
            throw new InvalidArgumentException('parse_user_agent requires a user agent');
        }
    }

    $platform = null;
    $browser  = null;
    $version  = null;

    $empty = array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

    if( !$u_agent ) return $empty;

    if( preg_match('/\((.*?)\)/im', $u_agent, $parent_matches) ) {

        preg_match_all('/(?P<platform>BB\d+;|Android|CrOS|iPhone|iPad|Linux|Macintosh|Windows(\ Phone)?|Silk|linux-gnu|BlackBerry|PlayBook|Nintendo\ (WiiU?|3DS)|Xbox(\ One)?)
                (?:\ [^;]*)?
                (?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);

        $priority           = array( 'Android', 'Xbox One', 'Xbox' );
        $result['platform'] = array_unique($result['platform']);
        if( count($result['platform']) > 1 ) {
            if( $keys = array_intersect($priority, $result['platform']) ) {
                $platform = reset($keys);
            } else {
                $platform = $result['platform'][0];
            }
        } elseif( isset($result['platform'][0]) ) {
            $platform = $result['platform'][0];
        }
    }

    if( $platform == 'linux-gnu' ) {
        $platform = 'Linux';
    } elseif( $platform == 'CrOS' ) {
        $platform = 'Chrome OS';
    }

    preg_match_all('%(?P<browser>Camino|Kindle(\ Fire\ Build)?|Firefox|Iceweasel|Safari|MSIE|Trident/.*rv|AppleWebKit|Chrome|IEMobile|Opera|OPR|Silk|Lynx|Midori|Version|Wget|curl|NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
            (?:\)?;?)
            (?:(?:[:/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix',
        $u_agent, $result, PREG_PATTERN_ORDER);


    // If nothing matched, return null (to avoid undefined index errors)
    if( !isset($result['browser'][0]) || !isset($result['version'][0]) ) {
        return $empty;
    }

    $browser = $result['browser'][0];
    $version = $result['version'][0];

//    $find = function ( $search, &$key ) use ( $result ) {
//        $xkey = array_search(strtolower($search), array_map('strtolower', $result['browser']));
//        if( $xkey !== false ) {
//            $key = $xkey;
//
//            return true;
//        }
//
//        return false;
//    };

    $key = 0;
    if( $browser == 'Iceweasel' ) {
        $browser = 'Firefox';
    } elseif( $find('Playstation Vita', $key) ) {
        $platform = 'PlayStation Vita';
        $browser  = 'Browser';
    } elseif( $find('Kindle Fire Build', $key) || $find('Silk', $key) ) {
        $browser  = $result['browser'][$key] == 'Silk' ? 'Silk' : 'Kindle';
        $platform = 'Kindle Fire';
        if( !($version = $result['version'][$key]) || !is_numeric($version[0]) ) {
            $version = $result['version'][array_search('Version', $result['browser'])];
        }
    } elseif( $find('NintendoBrowser', $key) || $platform == 'Nintendo 3DS' ) {
        $browser = 'NintendoBrowser';
        $version = $result['version'][$key];
    } elseif( $find('Kindle', $key) ) {
        $browser  = $result['browser'][$key];
        $platform = 'Kindle';
        $version  = $result['version'][$key];
    } elseif( $find('OPR', $key) ) {
        $browser = 'Opera Next';
        $version = $result['version'][$key];
    } elseif( $find('Opera', $key) ) {
        $browser = 'Opera';
        $find('Version', $key);
        $version = $result['version'][$key];
    } elseif( $find('Midori', $key) ) {
        $browser = 'Midori';
        $version = $result['version'][$key];
    } elseif( $find('Chrome', $key) ) {
        $browser = 'Chrome';
        $version = $result['version'][$key];
    } elseif( $browser == 'AppleWebKit' ) {
        if( ($platform == 'Android' && !($key = 0)) ) {
            $browser = 'Android Browser';
        } elseif( strpos($platform, 'BB') === 0 ) {
            $browser  = 'BlackBerry Browser';
            $platform = 'BlackBerry';
        } elseif( $platform == 'BlackBerry' || $platform == 'PlayBook' ) {
            $browser = 'BlackBerry Browser';
        } elseif( $find('Safari', $key) ) {
            $browser = 'Safari';
        }

        $find('Version', $key);

        $version = $result['version'][$key];
    } elseif( $browser == 'MSIE' || strpos($browser, 'Trident') !== false ) {
        if( $find('IEMobile', $key) ) {
            $browser = 'IEMobile';
        } else {
            $browser = 'MSIE';
            $key     = 0;
        }
        $version = $result['version'][$key];
    } elseif( $key = preg_grep('/playstation \d/i', array_map('strtolower', $result['browser'])) ) {
        $key = reset($key);

        $platform = 'PlayStation ' . preg_replace('/[^\d]/i', '', $key);
        $browser  = 'NetFront';
    }

    return array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

}
?>