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

me.Load=function(){
	var myData = {};

	me.ClearData();
	$.ajax({
		url:me.url+'?mode=Load&mod='+me.mod+'&'+new Date().getTime(),
		type:'GET',
		dataType:'json',
		data:myData,
		success:function(data){
			ft.PutForm(data.row);
			me.MsgInfo('Load complete!!', 1);
			$('#lyAddEdit input').first().focus();
		}
	});
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
	me.Load();
});