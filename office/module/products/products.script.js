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
		{name:'filepic', display:'รูป', width:'50', align:'center'},
		{name:'id', display:'รหัสสินค้า', width:'100', align:'center'},
		{name:'name', display:'ชื่อ'},
		{name:'type_code', display:'กลุ่ม'},
		{name:'cat_code', display:'ประเภท'},
		{name:'brand_code', display:'ยี่ห้อ'},
		{name:'cost', display:'ราคาทุน', align:'right'},
		{name:'price', display:'ราคาขาย', align:'right'},
		{name:'point', display:'แต้ม', align:'right'},
		{name:'quantity', display:'ปริมาณ', align:'right'},
		{name:'unit_code', display:'หน่วย', align:'center'}
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
	
	$('.permdata').attr('checked', false);
	$('.permdata').parent().removeClass('checked');
};

me.ClearError=function(){
  $('#lyAddEdit .err').css('display', 'none');
	$('.form-group').removeClass('has-error');
};

me.CheckForm=function(){
	me.ClearError();
  return ft.CheckEmpty('empty');
};

me.CheckPermAll=function(){
	$('#chkprmviewall').click(function(){
		if($(this).is(':checked')){
			$('.permviewdata').attr('checked', true);
			$('.permviewdata').parent().addClass('checked');
		}else{
			$('.permviewdata').attr('checked', false);
			$('.permviewdata').parent().removeClass('checked');
		}
	});
	
	$('#chkprmaddall').click(function(){
		if($(this).is(':checked')){
			$('.permadddata').attr('checked', true);
			$('.permadddata').parent().addClass('checked');
		}else{
			$('.permadddata').attr('checked', false);
			$('.permadddata').parent().removeClass('checked');
		}
	});
	
	$('#chkprmeditall').click(function(){
		if($(this).is(':checked')){
			$('.permeditdata').attr('checked', true);
			$('.permeditdata').parent().addClass('checked');
		}else{
			$('.permeditdata').attr('checked', false);
			$('.permeditdata').parent().removeClass('checked');
		}
	});
	
	$('#chkprmdelall').click(function(){
		if($(this).is(':checked')){
			$('.permdeldata').attr('checked', true);
			$('.permdeldata').parent().addClass('checked');
		}else{
			$('.permdeldata').attr('checked', false);
			$('.permdeldata').parent().removeClass('checked');
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
		data : ft.LoadForm('mydata'),
		permission : [],
		img : []
	};	
	
	var n=0;
	$('.permdata').each(function(i, obj){
		if($(obj).parent().hasClass('checked')){
			myData.permission[n] = {
				menu_id : $(this).attr('code'),
				pertype : $(this).attr('rel')
			};
			n++;
		}
	});

	$('.imgdata').each(function(i){
		myData.img[i] = $(this).text();
	});

	$.ajax({
		url:me.url+'?mode=Edit&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					me.Load(me.code);
					me.MsgSuccess(me.alert.savecomplete);
				break;
				default :
					me.MsgError(me.alert.saveerror);
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
			ft.PutForm(data.row);
			
			$('#lyImage').text('');
			me.AppendImage(data.pic);
			
			$(data.row).each(function(i, attr){
				if(attr.name == 'filepic'){
					$('.pinimg').removeClass('colorblue');
					$('#pinimg_'+attr.value).addClass('colorblue');
				}
			});
			
			$('#firstcode').val(data.firstcode);
			$('#prevcode').val(data.prevcode);
			$('#nextcode').val(data.nextcode);
			$('#lastcode').val(data.lastcode);
			
			$('#tabviewlist').css('display', 'none');
			$('#tabaddedit').css('display', 'block');
			$('#tooladd').css('display', 'none');
			$('#tooledit').css('display', 'block');
			$('#toolview').css('display', 'none');
			$('#lyStatus').css('display', 'block');
			
			$('.permdata').attr('checked', false);
			$('.permdata').parent().removeClass('checked');
			$(data.permission).each(function(i, attr){
				$('#'+attr.menu_id+attr.pertype).attr('checked', true);
				$('#'+attr.menu_id+attr.pertype).parent().addClass('checked');
			});
			
			$('#lyAddEdit input').first().focus();
			
			me.MsgInfo(me.alert.loadcomplete, 1);
		}
	});
};

me.LoadCbo=function(){
  $.getJSON(me.url+'?mode=LoadCbo&mod='+me.mod+'&'+new Date().getTime(), {}, function(data){
    $.each(data.cattype, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#type_code');
    });
    $.each(data.brand, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#brand_code');
    });
    $.each(data.unit, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#unit_code');
    });
	});
};

me.ChangeType=function(){
	$('#type_code').change(function(){
		me.LoadCboCat('');
	});
};

me.LoadCboCat=function(code){
	$('#cat_code').empty();
  $.getJSON(me.url+'?mode=LoadCboCat&mod='+me.mod+'&'+new Date().getTime(), {
		type_code : $('#type_code').val()
	}, function(data){
    $.each(data, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#cat_code');
    });
		$('#cat_code').select2('val', code);
	});
};

me.OpenUpload=function(){
	$('#boxUpload').modal('show');
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
	me.LoadCbo();
	me.ViewHeader();
	me.ViewSearch();
	me.View();
	me.CheckPermAll();
	me.SetUpload();
	me.TextEditor();
	me.ChangeType();
});