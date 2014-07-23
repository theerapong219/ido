/*================================================*\
*  Author : Tirapant Tongpann
*  Created Date : 14/06/2011 01:29
*  Module : main.func.js
*  Description : FUNCTION
*  Involve People : -
*  Last Updated : 19/03/2013 16:06
\*================================================*/

/*================================================*\
  :: _FUNCTION_ ::
\*================================================*/
var ft={};

ft.LoadForm=function(selector){
	var form = {};
	var self, name, tmp;
	$('.'+selector).each(function(i){
		self = $(this);
		name = self.attr('name');
		
		if(self.is('input:text')){
			if(self.hasClass('dtpk')){
				form[name] = ft.DateTimeFormat(self.val());
			}else if(self.hasClass('dpk')){
				form[name] = ft.DateFormat(self.val());
			}else if(self.hasClass('tpk')){
				form[name] = ft.TimeFormat(self.val());
			}else if(self.hasClass('num')){
				form[name] = ft.NumberFormat(self.val(), 0);
			}else if(self.hasClass('num2')){
				form[name] = ft.NumberFormat(self.val());
			}else{
				form[name] = ft.Trim(self.val());
			}
		}else if(self.is('input:password')){
			form[name] = ft.Trim(self.val());
		}else if(self.is('input:hidden')){
			if(self.hasClass('dtpk')){
				form[name] = ft.DateTimeFormat(self.val());
			}else if(self.hasClass('dpk')){
				form[name] = ft.DateFormat(self.val());
			}else if(self.hasClass('tpk')){
				form[name] = ft.TimeFormat(self.val());
			}else if(self.hasClass('num')){
				form[name] = ft.NumberFormat(self.val(), 0);
			}else if(self.hasClass('num2')){
				form[name] = ft.NumberFormat(self.val());
			}else{
				form[name] = ft.Trim(self.val());
			}
		}else if(self.is('textarea')){
			form[name] = ft.Trim(self.val());
		}else if(self.is('select')){
			form[name] = ft.Trim(self.val());
		}else if(self.is('input:radio')){
			form[name] = ft.GetRadio(name);
		}else if(self.is('input:checkbox')){
			if(self.is(':checked')){
				form[name] = 'Y';
			}else{
				form[name] = 'N';
			}
		}
	});
	
	return form;
};

ft.PutForm=function(data){
	var self;
	$.each(data, function(i, attr) {
		self = $('#'+attr.name);
		if(self.is('input:text')){
			if(self.hasClass('dtpk')){
				self.val(ft.DateTimeDisplay(attr.value));
			}else if(self.hasClass('dpk')){
				self.val(ft.DateDisplay(attr.value));
			}else if(self.hasClass('tpk')){
				self.val(ft.TimeDisplay(attr.value));
			}else if(self.hasClass('num')){
				self.val(ft.NumberDisplay(attr.value, 0));
			}else if(self.hasClass('num2')){
				self.val(ft.NumberDisplay(attr.value, 2));
			}else if(self.hasClass('datetime')){
				self.val(ft.DateTimeDisplay(attr.value));
			}else{
				self.val(attr.value);
			}
		}else if(self.is('input:hidden')){
			if(self.hasClass('dtpk')){
				self.val(ft.DateTimeDisplay(attr.value));
			}else if(self.hasClass('dpk')){
				self.val(ft.DateDisplay(attr.value));
			}else if(self.hasClass('tpk')){
				self.val(ft.TimeDisplay(attr.value));
			}else if(self.hasClass('num')){
				self.val(ft.NumberDisplay(attr.value, 0));
			}else if(self.hasClass('num2')){
				self.val(ft.NumberDisplay(attr.value, 2));
			}else if(self.hasClass('datetime')){
				self.val(ft.DateTimeDisplay(attr.value));
			}else{
				self.val(attr.value);
			}
		}else if(self.is('input:password')){
			self.val(attr.value);
		}else if(self.is('textarea')){
			if(self.hasClass('editor')){
				attr.value = attr.value.split("\\\"").join("\"");
				self.val(attr.value);
			}else if(self.hasClass('editormin')){
				attr.value = attr.value.split("\\\"").join("\"");
				self.val(attr.value);
			}else{
				self.val(attr.value);
			}
		}else if(self.is('select')){
			self.val(attr.value);
		}else if(self.is('input:checkbox')){
			ft.SetCheckbox(attr.name, attr.value);
		}else if($('input[name="'+attr.name+'"]').is('input:radio')){
			ft.SetRadio(attr.name, attr.value);
		}else{
			self.val(attr.value);
		}
	});
};

ft.LoadRel=function(selector){
	var result={};
	var i = 0;
	$('.'+selector).each(function(){
		result[i] = $(this).attr('rel');
		i++;
	});
	
	return result;
};

ft.CheckEmpty=function(selector){
	var chk=true;
	$('.'+selector).each( function(){
		$(this).val(ft.Trim($(this).val()));
		var self = $(this);
		var id = self.attr('id');
		if(self.val()==''){
			if((self.is('input:text')) || (self.is('input:password')) || (self.is('textarea')) || (self.is('select'))){
				$('#dv'+id).addClass('has-error');
				$('#e'+id).css('display', 'block');
				chk=false;
			}
		}
	});
	return chk;
};

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
};

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
};

ft.LTrim=function(str){
	if (str==null){
		return null;
	}
	for(var i=0; str.charAt(i)==" "; i++);
	return str.substring(i,str.length);
};

ft.RTrim=function(str){
	if (str==null){
		return null;
	}
	for(var i=str.length-1;str.charAt(i)==" ";i--);
	return str.substring(0,i+1);
};

ft.Trim=function(str){
	str = str + '';
	str =  ft.LTrim(ft.RTrim(str));
	str = str.split("'").join("\'");
	return str;
};

ft.Today=function(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	var date = now.getDate();

	date = (date<10)?'0'+date:date;
	month = (month<10)?'0'+month:month;
	return date+'/'+month+'/'+year;
};

ft.DateTimeFormat=function(date){
	var arr = date.split(' ');
	var dt = arr[0].split('/');
	var tm = arr[1].split(':');
	
	return dt[2]+dt[1]+dt[0]+tm[0]+tm[1]+'00';
};

ft.DateFormat=function(date){
	var dt = date.split('/');
	return dt[2]+dt[1]+dt[0];
};

ft.TimeFormat=function(date){
	var dt = date.split(':');
	return dt[0]+dt[1];
};

ft.DateTimeDisplay=function(date){
	date = date + '';
	var y = date.substring(0,4);
	var m = date.substring(5,7);
	var d = date.substring(8,10);
	var h = date.substring(11,13);
	var i = date.substring(14,16);
	var s = date.substring(17,19);
	
	var result = '';
	if(y!='0000'){
		result = d+'/'+m+'/'+y+' '+h+':'+i;
	}
	
	return result;
};

ft.DateDisplay=function(date){
	date = date + '';
	var y = date.substring(0,4);
	var m = date.substring(5,7);
	var d = date.substring(8,10);
	
	var result = '';
	if(y!='0000'){
		result = d+'/'+m+'/'+y;
	}
	
	return result;
};

ft.TimeDisplay=function(date){
	date = date + '';
	var h = date.substring(0,2);
	var i = date.substring(2,4);
	
	return h+':'+i;
};

ft.IsTel=function(str){
	var RegExp =  /^(\+|)[0-9][(0-9)|\-]{8,15}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsDate=function(str){
	var RegExp =  /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
	
	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsMobile=function(str){
	var RegExp =  /^08[0-9]{8}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsUserName=function(str){
	var RegExp = /^[a-zA-Z0-9_.-]{5,25}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsDigit=function(str){
	var RegExp = /^([0-9]*)(.|)([0-9]*)$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsPrice=function(str){
	var RegExp = /^([0-9,,]*)(.|)([0-9]*)$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsPassword=function(str){
	var RegExp = /^[a-zA-Z0-9_.\-@!%\^\$&#]{4,25}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsEmail=function(str){
	var RegExp = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsZipCode=function(str){
	var RegExp = /^[0-9]{5}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.IsSubDomain=function(str){
	var RegExp = /^[a-zA-Z0-9_-]{3,20}$/;

	if(RegExp.test(str)){
		return true;
	}else{
		return false;
	}
};

ft.GetRadio=function(name){
	var value = $('input[name='+name+']:checked').attr('rel');
	if(typeof(value) == 'undefined'){
		value = '';
	}

	return value;
};

ft.SetRadio=function(name, value){
	$('input:radio[name="'+name+'"]').filter('[rel="'+value+'"]').prop('checked', true);
};

ft.SetCheckbox=function(name, value){
	if(value=='Y'){
		$('#'+name).attr('checked', true);
	}else{
		$('#'+name).attr('checked', false);
	}
};

ft.Get=function(name) {
  return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,''])[1]);
};

ft.GetParam=function(){
	var url = window.location.toString();
	var arrs = url.split('#');
	var result={};
	if(arrs.length > 1){
		result['charp'] = arrs[1];
		url = arrs[0];
	}else{
		result['charp'] = '';
	}
	
	var arr = url.split('?');
	result['domain'] = arr[0];
	result['param'] = {};
	if(arr.length > 1){
		var param = arr[1].split('&');
		var name;

		$.each(param, function(i, value){
			name = value.split('=');
			result['param'][name[0]] = name[1];
		});
	}
	
	return result;
};

ft.GetBack=function() {
  return window.location.href.split('#')[1];
};

ft.IsAlpha=function(ch){
	if((ch<'0')||(ch>'9')){
		return true;
	}else{
		return false;
	}
};

ft.CheckTime=function(Data){
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
		//Data=parseInt(Data);
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
	}else if(ft.IsAlpha(c_h1) || ft.IsAlpha(c_h2) || ft.IsAlpha(c_m1) || ft.IsAlpha(c_m2)){
		Data = "00:00";
	}else{
		Data = h1+''+h2+''+':'+m1+''+m2;
	}
	return(Data);
};

ft.ClearNumber=function(number){
	var num = number.toString();
	num = num.split('$').join('');
	num = num.split('฿').join('');
	num = num.split('%').join('');
	num = num.split(',').join('');
	return num;
};

ft.AddCommas=function(nStr){
	nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
};

ft.NumberFormat=function(tmp){
	tmp = ft.ClearNumber(tmp);
	var result = parseFloat(tmp);
	if(isNaN(result)){
		result = 0.0;
	}
	return result+'{type:int}';
};

ft.Number=function(tmp){
	tmp = ft.ClearNumber(tmp);
	var result = parseFloat(tmp);
	if(isNaN(result)){
		result = 0.0;
	}
	return result;
};

ft.NumberDisplay=function(num, n){
	num = num+'';
	num = ft.Number(num);
	if(n == null){
		n = 2;
	}
	return ft.AddCommas(num.toFixed(n));
};

ft.Exist=function(name){
	var found = typeof(name) === undefined;
	
	return !found;
};

ft.Debug=function(str){
	if(!$('#debug').exist()){
		$('<div id="debug" ondblclick="$(\'#debug\').remove();" style="position:fixed; bottom:5px; right:5px; height:auto; max-height:80%; overflow:auto; min-width:1px; border:3px darkgray double; background-color:white; z-index:9999; padding:5px 10px;"></div>').appendTo('body');
	}
	
	var output = '';
	if($.isArray(str) || typeof(str) == 'object') {
		output = ft.print_r(str, true);
	}else{
		output = str+'';
		output = output.split('<').join('&lt;');
		output = output.split('>').join('&gt;');
	}
	
	var no = $('#debug div').length + 1;
	$('#debug').append('<div style="border-bottom:1px solid #e2e2e2; padding:3px 20px 3px 3px; font-size:13px; color:black; white-space:nowrap;">'+output+'</div>');
};

ft.print_r=function(printthis, returnoutput){
	var output = '';

	if($.isArray(printthis) || typeof(printthis) == 'object') {
		for(var i in printthis) {
			output += i + ' : ' + ft.print_r(printthis[i], true) + '<br/>';
		}
	}else {
		output += printthis;
	}
	if(returnoutput && returnoutput == true) {
		return output;
	}else {
		alert(output);
	}
};

ft.TimeCode=function(){
	return new Date().getTime();
};

ft.FindStr=function(find, str){
	if(find===undefined || str===undefined){
		return false;
	}else{
		str = str + '';
		return str.indexOf(find)>0;
	}
};

/*================================================*\
  :: jQuery ::
\*================================================*/
$.fn.numberDisplay=function(n){
	var num = ft.Number($(this).val());
	if(n == null){
		n = 2;
	}

	$(this).val(ft.AddCommas(num.toFixed(n)));
};

$.fn.numberFormat=function(){
	return ft.NumberFormat($(this).val());
};

$.fn.today=function(){
	var now = new Date();
	var year = now.getFullYear();
	var month = now.getMonth() + 1;
	var date = now.getDate();

	date = (date<10)?'0'+date:date;
	month = (month<10)?'0'+month:month;
	$(this).val(date+'/'+month+'/'+year);
};

$.fn.trim=function(){
	var str = ft.LTrim(ft.RTrim($(this).val()));
	$(this).val(str);
};

$.fn.time=function(){
	$(this).val(ft.CheckTime($(this).val()));
};

$.fn.btn=function(icon){
	var ico = (typeof(icon) != 'undefined')?{icons:{primary:'ui-icon-'+icon}}:{icons:{primary:'ui-icon-document'}};
	$(this).addClass('ui-state-default').addClass('ui-corner-all').button(ico);

	$(this).hover(
		function() {$(this).addClass('ui-state-hover');},
		function() {$(this).removeClass('ui-state-hover');}
	);
};

$.fn.dateFormat=function(){
	var date = $(this).val().split('/');
	var d = date[0];
	var m = date[1];
	var y = date[2];
	
	$(this).val(y+'-'+m+'-'+d);
};

$.fn.getDate=function(){
	var date = $(this).val().split('/');
	var d = date[0];
	var m = date[1];
	var y = date[2];
	
	return y+'-'+m+'-'+d;
};

$.fn.exist=function(){
	return $(this).length > 0;
};

$.stringify = $.stringify || function (obj) {
	var t = typeof (obj);
	if (t != "object" || obj === null) {
		if (t == "string") obj = '"'+obj+'"';
		return String(obj);
	}else{
		var n, v, json = [], arr = (obj && obj.constructor == Array);
		for (n in obj) {
			v = obj[n];
			t = typeof(v);
			if (t == "object" && v !== null) v = $.stringify(v);
			else if (ft.IsDate(v)) v = ft.DateFormat(v);
			else if (t == "string") v = "'"+v+"'";
//			else if (t == "number") v = v;

			json.push((arr ? "" : '' + n + ':') + String(v));
		}
		return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
	}
};



  

