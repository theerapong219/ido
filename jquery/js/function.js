/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 14/6/2554 1:29
*  Module : Compile
*  Description : _FUNCTION_
*  Involve People : -
*  Last Updated : 14/6/2554 1:29
==================================================*/

/*==================================================
  :: _FUNCTION_ ::
==================================================*/
var ft={};

ft.LoadForm=function(selector){
	var form = {};
	$('.'+selector).each(function(){
		var self = $(this);
		var name = self.attr('name');
		if(self.is('input:text')){
			form[name] = ft.Trim(self.val());
		}else if(self.is('textarea')){
			form[name] = ft.Trim(self.val());
		}else if(self.is('input:checkbox')){
			if(self.is(':checked')){
				form[name] = 'Y';
			}else{
				form[name] = 'N';
			}
		}else if(self.is('input:radio')){
			form[name] = ft.GetRadio(name);
		}else{
			form[name] = self.val();
		}
	});
	return form;
}

ft.LoadValue=function(selector){
	var result={};
	var i = 0;
	$('.'+selector).each(function(){
		result[i] = $(this).val();
		i++;
	});
	
	return result;
}

ft.LoadRel=function(selector){
	var result={};
	var i = 0;
	$('.'+selector).each(function(){
		result[i] = $(this).attr('rel');
		i++;
	});
	
	return result;
}

ft.CheckEmpty=function(selector){
	var chk=true;
	$('.'+selector).each( function(){
		$(this).val(ft.Trim($(this).val()));
		var self = $(this);
		var id = '#e'+self.attr('id');
		if(self.val()==''){
			$(id).css('display', 'block');
			chk=false;
		}
	});
	return chk;
}

ft.CharThai=function(Obj) {
	var numWord = Obj.value.length;
	var chartext = '';
	for(i=0;i<numWord;i++) {
		ascii = Obj.value.charCodeAt(I);
		if( (ascii >= 3585 && ascii <=3641) || (ascii >= 3648 && ascii <=3662) || ascii == 32 || ascii == 46) {
			chartext = chartext+Obj.value.charAt(I);
		}else{
			Obj.value=chartext;
			return false;
		}
	}
	Obj.value=chartext;
	return true;
}

ft.CharEnglish=function(Obj) {
	var numWord = Obj.value.length;
	var chartext = '';
	for(i=0;i<numWord;i++) {
		ascii = Obj.value.charCodeAt(I);
		if( (ascii >= 65 && ascii <=90) || (ascii >= 97 && ascii <=122) || ascii == 32 || ascii == 46) {
			chartext = chartext+Obj.value.charAt(I);
		}else{
			Obj.value=chartext;
			return false;
		}
	}
	Obj.value=chartext;
	return true;
}

ft.LTrim=function(str){
	if (str==null){
		return null;
	}
	for(var i=0; str.charAt(i)==" "; i++);
	return str.substring(i,str.length);
}

ft.RTrim=function(str){
	if (str==null){
		return null;
	}
	for(var i=str.length-1;str.charAt(i)==" ";i--);
	return str.substring(0,i+1);
}

ft.Trim=function(str){
	return ft.LTrim(ft.RTrim(str));
}

ft.Today=function(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	var date = now.getDate();

	date = (date<10)?'0'+date:date;
	month = (month<10)?'0'+month:month;
	return date+'/'+month+'/'+year;
}

ft.DateTimeFormat=function(date){
	var now = new Date(date);
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	var day = now.getDate();
	var minute = now.getMinutes();
	var second = now.getSeconds();

	month = (month<10)?'0'+month:month;
	day = (day<10)?'0'+day:day;
	minute = (minute<10)?'0'+minute:minute;
	second = (second<10)?'0'+second:second;
	return year+'-'+month+'-'+day+' '+minute+':'+second;
}

ft.IsTel=function(str){
	var RegExp =  /^(\+|)[0-9][(0-9)|\-]{8,15}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsMobile=function(str){
	var RegExp =  /^08[0-9]{8}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsUserName=function(str){
	var RegExp = /^[a-zA-Z0-9_.-]{5,25}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsDigit=function(str){
	var RegExp = /^([0-9]*)(.|)([0-9]*)$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsPassword=function(str){
	var RegExp = /^[a-zA-Z0-9_.\-@!%\^\$&#]{5,25}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsEmail=function(str){
	var RegExp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsZipCode=function(str){
	var RegExp = /^[0-9]{5}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.IsSubDomain=function(str){
	var RegExp = /^[a-zA-Z0-9_-]{3,20}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
}

ft.GetRadio=function(name){
	return $('input[name='+name+']:checked').val();
}

ft.SetRadio=function(name, value){
	$('input:radio[name='+name+']').filter('[value='+value+']').attr('checked', true);
}

ft.SetCheckbox=function(name, value){
	if(value=='Y'){
		$('#'+name).attr('checked', true);
	}else{
		$('#'+name).attr('checked', false);
	}
}

ft.Get=function(name) {
  return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]);
}

ft.GetBack=function() {
  return window.location.href.split('#')[1];
}

/*==================================================
  :: NUM ::
==================================================*/
var nm={};

nm.Format=function(obj, n){
	var tmp = $(obj).val();
	tmp = tmp.split('$').join('');
	tmp = tmp.split('฿').join('');
	tmp = tmp.split('%').join('');
	tmp = tmp.split(',').join('');

	var num = parseFloat(tmp);
	if(isNaN(num)){
		num=0;
		$(obj).val(num.toFixed(n));
	}else{
		$(obj).val(nm.AddCommas(num.toFixed(n)));
	}
}

nm.FormatComma=function(obj, n, symbol){
	var tmp = $(obj).val();
	tmp = tmp.split(symbol).join('');
	tmp = tmp.split(',').join('');

	var num = parseFloat(tmp);
	if(isNaN(num)){
		num=0;
		$(obj).val(symbol+num.toFixed(n));
	}else{
		$(obj).val(symbol+nm.AddCommas(num.toFixed(n)));
	}
}

nm.GetValueComma=function(num, n, symbol){
	return symbol+nm.AddCommas(num.toFixed(n));
}

nm.Number=function(tmp){
	if(tmp=='')return 0.0;
	tmp = tmp.split('$').join('');
	tmp = tmp.split('฿').join('');
	tmp = tmp.split('%').join('');
	tmp = tmp.split(',').join('');
	var result = parseFloat(tmp);
	if(isNaN(result)){
		result = 0.0;
	}
	return result;
}

nm.FormatNumber=function(numset, n){
	var num = parseFloat(numset);
	if(isNaN(num)){
		num=0;
		return '0.00';
	}else{
		if(n == null){
			n = 2;
		}
		return nm.AddCommas(num.toFixed(n));
	}
};

nm.Degit=function(obj, n){
	var num = parseFloat(obj.value);
	if(isNaN(num)){
		num=0;
	}
	$(obj).val(num.toFixed(n));
}

nm.AddCommas=function(nStr){
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

/*=======================================
	:: TIME ::
=======================================*/
var tm = {};

tm.IsAlpha = function(ch){
	if((ch<'0')||(ch>'9')){
		return true;
	}else{
		return false;
	}
}

tm.CheckTime = function(Data){
	if((Data.indexOf(':')==2)||(Data.indexOf('.')==2)){
		Data1=Data.substr(0,2);
		Data2=Data.substr(3,2);
		Data=Data1+Data2;
		if(Data>2359 || Data2>59 || Data1>23){
			Data=0;
		}
	}else if((Data.indexOf(':')==1)||(Data.indexOf('.')==1)){

		Data='0'+Data;
		Data1=Data.substr(0,2);
		Data2=Data.substr(3,2);
		Data=Data1+Data2;
		if(Data>2359 || Data2>59 || Data1>23){
			Data=0;
		}
	}else{
		Data=Data.substr(0,4);
		Data1=Data.substr(0,2);
		Data2=Data.substr(2,2);
		if(Data>2359 || Data2>59 || Data1>23){
			Data=0;
		}
	}
	Data = Data.toString();
	h1=Data.substr(0,1);
	if(h1=='.'){
		h1=0;
	}
	h2=Data.substr(1,1);
	if(h2=='.'){
		h2=0;
	}
	m1=Data.substr(2,1);
	if(m1=='.'){
		m1=0;
	}
	m2=Data.substr(3,1);
	if(m2=='.'){
		m2=0;
	}
	c_h1 = h1.toString();
	c_h2 = h2.toString();
	c_m1 = m1.toString();
	c_m2 = m2.toString();
	if(Data.length<4 || c_h1=="NaN" || c_h1>2 || c_h1<0 || c_h2=="NaN" || c_h2>9 || c_h2<0 || c_m1=="NaN" || c_m1>6 || c_m1<0 || c_m2=="NaN" || c_m2>9 || c_m2<0){
		Data = "00:00";
	}else if(tm.IsAlpha(c_h1) || tm.IsAlpha(c_h2) || tm.IsAlpha(c_m1) || tm.IsAlpha(c_m2)){
		Data = "00:00";
	}else{
		Data = h1+''+h2+''+':'+m1+''+m2;
	}
	return(Data);
}

/*==================================================
  :: jQuery ::
==================================================*/
$.fn.formatNumber=function(point){
	var p = parseFloat(point);
	if(isNaN(p)){
		p=0;
	}

	var num = nm.Number($(this).val());
//	var num = parseFloat($(this).val());
	if(isNaN(num)){
		num=0;
	}

	$(this).val(nm.AddCommas(num.toFixed(p)));
}

$.fn.number=function(){
	var num = nm.Number($(this).val());
	$(this).val(num);
}

$.fn.today=function(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	var date = now.getDate();

	date = (date<10)?'0'+date:date;
	month = (month<10)?'0'+month:month;
	$(this).val(date+'/'+month+'/'+year);
}

$.fn.trim=function(){
	var str = ft.LTrim(ft.RTrim($(this).val()));
	$(this).val(str);
}

$.fn.time=function(){
	$(this).val(tm.CheckTime($(this).val()));
}

$.fn.btn=function(icon, prim){
	if(typeof(icon) == 'undefined')icon = 'ui-icon-document';
	if(typeof(prim) == 'undefined')prim = 'front';
//		alert(prim);
	var ico = {};
	if(prim == 'front'){
		ico = {icons:{primary:icon}};
	}else if(prim == 'back'){
		ico = {icons:{secondary:icon}};
	}
	
	$(this).addClass('ui-state-default').addClass('ui-corner-all').button(ico);

	$(this).hover(
		function() {$(this).addClass('ui-state-hover');},
		function() {$(this).removeClass('ui-state-hover');}
	);
}






