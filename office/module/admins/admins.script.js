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
		{name:'id', display:me.define.id, align:'center', width:'30%'},
		{name:'name', display:me.define.name},
		{name:'surname', display:me.define.surname}
	]);
};

me.ViewSearch=function(){
	me.ViewSetSearch([
		{name:'id', display:me.define.id},
		{name:'name', display:me.define.name},
		{name:'surname', display:me.define.surname}
	]);
};

me.ClearData=function(){
	$('#lyAddEdit input').val('');
	$('#lyAddEdit select').val('');
	$('#lyAddEdit textarea').val('');
	$('#tbSubMenu').text('');
	$('#tbImage').text('');
};

me.ClearError=function(){
  $('#lyAddEdit .err').css('display', 'none');
	$('.form-group').removeClass('has-error');
};

me.CheckForm=function(){
	me.ClearError();
  return ft.CheckEmpty('empty');
};

me.Add=function(){
	if(!me.CheckForm()){
		$('#lyAddEdit input').first().focus();
		setTimeout('me.ClearError();', 5000);
		return;
	}
	if(!confirm(me.alert.calladd))return;

	var myData = {
		data : ft.LoadForm('mydata')
	};
	
	myData.data['picture'] = ft.GetRadio('defaultimg');
	
	var filepic = [];
	$('.imgdata').each(function(i){
		filepic[i] = {
			code : $(this).attr('rel'),
			name : $(this).find('.namedata').text(),
			size : $(this).find('.sizedata').text()	
		}
	});	
	if(filepic.length > 0){
		myData.data['filepic'] = filepic;
	}else{
		myData.data['filepic'] = '';
	}
	
	$.ajax({
		url:me.url+'?mode=Add&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					me.MsgSuccess(me.alert.savecomplete);
					me.Clear();
					me.View();
				break;
				default :
					alert(me.alert.savenotcomplete);
				break;
			}
		}
	});
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
	
	myData.data['picture'] = ft.GetRadio('defaultimg');
	
	var filepic = [];
	$('.imgdata').each(function(i){
		filepic[i] = {
			code : $(this).attr('rel'),
			name : $(this).find('.namedata').text(),
			size : $(this).find('.sizedata').text()	
		}
	});	
	if(filepic.length > 0){
		myData.data['filepic'] = filepic;
	}else{
		myData.data['filepic'] = '';
	}

	$.ajax({
		url:me.url+'?mode=Edit&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					me.MsgSuccess(me.alert.savecomplete);
					me.View();
					me.Load(me.code);
				break;
				default :
					me.MsgError(me.alert.savenotcomplete);
				break;
			}
		}
	});
};

me.Load=function(code){
	var myData = {
		code : code
	};

	me.ClearData();
	$.ajax({
		url:me.url+'?mode=Load&mod='+me.mod+'&'+new Date().getTime(),
		type:'GET',
		dataType:'json',
		data:myData,
		success:function(data){
			me.code = code;
			me.task='EDIT';
			$('#Delete').attr('disabled', false);
			ft.PutForm(data.row);
			
			var picture = '';
			$.each(data.row, function(i, attr){
				if(attr.name == 'filepic'){
					if(attr.value.length > 0){
						$(attr.value).each(function(j, item){
							me.AppendUpload({
								code : item.code,
								name : item.name,
								size : item.size,
								url : me.site+'/img/pic-'+item.name+'.jpg',
								thumb : me.site+'/img/pic-'+item.name+'-50.jpg'
							});
						});
					}
				}else if(attr.name == 'picture'){
					picture = attr.value;
				}
			});
			ft.SetRadio('defaultimg', picture);
			me.MsgInfo(me.alert.loadcomplete, 1);
			$('#lyAddEdit input').first().focus();
		}
	});
};

me.LoadCbo=function(){
  $.getJSON(me.url, {mode:'LoadCbo', mod:me.mod, Time:new Date().getTime()}, function(data){
    $.each(data.branch, function(i, result) {
      $('<option>').attr('value', result.id).text(result.name).appendTo('#user_branch');
    });
	});
};

/*==================================================
  :: DEFAULT ::
==================================================*/

$(document).ready(function(){
	me.SetUrl();
	me.ViewHeader();
	me.ViewSearch();
	me.View();
	me.LoadCbo();
	me.SetUpload();
});