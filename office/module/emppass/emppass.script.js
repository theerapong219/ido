/*================================================*\
*  Author : BoyBangkhla
*  Created Date : 05/12/2013 09:09
*  Module : Script
*  Description : Backoffice javascript
*  Involve People : MangEak
*  Last Updated : 05/12/2013 09:09
\*================================================*/

/*================================================*\
  :: FUNCTION ::
\*================================================*/
me.ViewHeader=function(){
	me.ViewSetHeader([
		{name:'code', display:'ID', width:'100', align:'center'},
		{name:'name', display:'Name'}
	]);
};

me.ViewSearch=function(){
	me.ViewSetSearch([
		{name:'name', display:'name'}
	]);
};

me.ClearData=function(){
	$('#lyAddEdit input').val('');
	$('#lyAddEdit select').val('');
	$('#lyAddEdit textarea').val('');
};

me.ClearError=function(){
  $('#lyAddEdit .err').css('display', 'none');
	$('.form-group').removeClass('has-error');
};

me.CheckForm=function(){
	me.ClearError();
  return ft.CheckEmpty('empty');
};

me.Edit=function(){
	if(!me.CheckForm()){
		$('#lyAddEdit input').first().focus();
		setTimeout('me.ClearError();', 5000);
		return;
	}
	if(!confirm(me.alert.calledit))return;

	var myData = {
		code : me.code,
		data : ft.LoadForm('mydata')
	};	

	$.ajax({
		url:me.url+'?mode=Edit&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					me.ClearData();
					me.MsgSuccess(me.alert.savecomplete);
				break;
				case 'OLDPASS' :
					me.MsgError('รหัสเดิมไม่ถูกต้อง');
				break;
				case 'NEWPASS' :
					me.MsgError('กรุณาพิมพ์รหัสใหม่ให้เหมือนกัน');
				break;
				default :
					me.MsgError(me.alert.saveerror);
				break;
			}
		}
	});
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
});