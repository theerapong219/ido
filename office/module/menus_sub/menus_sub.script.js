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
		{name:'code', display:'รหัส', width:'100', align:'center'},
		{name:'name', display:'ชื่อเมนู'},
		{name:'menu_code', display:'เมนูหลัก', align:'center'},
		{name:'sort', display:'ลำดับ', width:'100', align:'center'}
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

me.ShowIcon=function(){
	$('#btnIcon').click(function(){
		$('#boxIcon').modal('show');
	});
};

me.SelectIcon=function(){
	$('#menuIcon .btn-link').click(function(){
		var icon = $(this).text();
		icon = ft.Trim(icon);
		icon = icon.split(' (alias)').join('');
		if($('#useicon').val()=='SUBMENU'){
			$('#subicon').val(icon);
		}else{
			$('#icon').val(icon);
		}
		
		$('#boxIcon').modal('hide');
	});
};

me.View=function(page){
	if(page===undefined)page=1;
	var myData = {
		sortby : $('#sortby').val(),
		sortorder : $('#sortorder').val(),
		limit : $('#cboLimit').val(),
		page : page,
		menu_code : me.get.param.menu,
		column : [],
		search : []
	};
	
	$('.searchdata').each(function(i){
		myData.search[i] = {
			searchby : $(this).attr('name'),
			searchkey : $(this).val()
		};
	});
	$(me.viewcolumn).each(function(i, attr){
		myData.column[i] = attr.name;
	});
	
	$('#tbView').text('');
	$('#thLoading').css('display', '');
	$('#tbView').css('display', 'none');
	$.ajax({
		url:me.url+'?mode=View&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			$('#ViewRecord').text(data.record);
			me.AppendView(data.row);
			me.AppendPage(data.page);
			$('#thLoading').css('display', 'none');
			$('#tbView').css('display', '');
		}
	});
};

me.LoadCbo=function(){
  $.getJSON(me.url+'?mode=LoadCbo&mod='+me.mod+'&'+new Date().getTime(), {}, function(data){
    $.each(data.menu, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#menu_code');
    });
	});
};

me.New=function(){
	$('#tabviewlist').css('display', 'none');
	$('#tabaddedit').css('display', 'block');
	
	$('#tooladd').css('display', 'block');
	$('#tooledit').css('display', 'none');
	$('#toolview').css('display', 'none');
	$('#lyStatus').css('display', 'none');
	
	me.ClearData();
	me.task='ADD';
	if(me.get.param.menu!==undefined){
		$('#menu_code').select2('val', me.get.param.menu);
	}
	
	$('#lyAddEdit input').first().focus();
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
	me.ViewHeader();
	me.ViewSearch();
	me.View();
	me.LoadCbo();
});