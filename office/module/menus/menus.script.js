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
		{name:'icon', display:'Icon', width:'70', align:'center'},
		{name:'sort', display:'ลำดับ', width:'70', align:'center'},
		{name:'enable', display:'เปิดใช้', width:'70', align:'center'},
		{name:'submenu', display:'ย่อย', width:'70', align:'center', search:false, sort:false}
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
	$('#lySubmenu').text('');	
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
	$('#btnicon').click(function(){
		$('#ModalIcon').modal('show');
	});
};

me.SelectIcon=function(){
	$('#menuIcon .btn-link').click(function(){
		var icon = $(this).text();
		icon = ft.Trim(icon);
		icon = icon.split(' (alias)').join('');
		$('#icon').val(icon);
		
		$('#ModalIcon').modal('hide');
	});
};

me.AppendView_=function(data){
	var html;
	var visible;
	$(data).each(function(i, field){
		html = '<tr id="tr'+field.code+'">';
		$(me.viewcolumn).each(function(j, attr){
			if(j>2){
				visible = 'visible-xs hidden-xs'
			}else{
				visible = ''
			}
			html += '<td class="'+visible+'" style="text-align:'+attr.align+'">'+field.item[j]+'</td>';
		});
		html += '<td class="text-right" style="white-space:nowrap;">';
    html += ' <button onclick="me.LoadSubMenu('+field.code+');" class="btn btn-xs btn-info" type="button"><i class="fa fa-list"></i> เมนูย่อย</button>';
		if(me.permission.edit=='1'){
			html += ' <button onclick="me.Load('+field.code+');" class="btn btn-xs btn-success" type="button"><i class="fa fa-edit"></i> '+me.define.edit+'</button>';
		}else{
			html += ' <button onclick="me.Load('+field.code+');" class="btn btn-xs btn-success" type="button"><i class="fa fa-search-plus"></i> '+me.define.open+'</button>';
		}
		if(me.permission.del=='1'){
			html += '	<button onclick="me.DelView('+field.code+');" class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i> '+me.define.del+'</button>';
		}
    html += '</td>';
		html += '</tr>';
		$('#tbView').append(html);
	});
};

me.LoadSubMenu=function(code){
	window.location.href = 'app.php?mod=menus_sub&parent=menu&menu='+code;
};

me.SetDefaultSort=function(){
	$('#sortby').val('sort');
	$('#sortorder').val('asc');
	
	$('.sortdata').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-unsorted');
	$('#sort_sort').addClass('fa-sort-asc').removeClass('fa-unsorted');	
};

me.OpenModalSubmenu=function(){
	$('#ModalSubmenu input').val('');
	ft.SetRadio('sub_enable', 'Y');
	$('#subeditid').text('');
	
	$('#btnAddSubmenu').css('display', '');
	$('#btnEditSubmenu').css('display', 'none');
	$('#sub_id').focus();
	
	$('#ModalSubmenu').modal('show');
};

me.Add=function(){
	if(!me.CheckForm()){
		$('#lyAddEdit input').first().focus();
		setTimeout('me.ClearError();', 5000);
		return;
	}
	if(!confirm(me.alert.calladd))return;

	var myData = {
		data : ft.LoadForm('mydata'),
		submenu : []
	};
	
	$('.submenudata').each(function(i){
		myData.submenu[i] = {
			id : $(this).find('.iddata').text(),
			name : $(this).find('.namedata').text(),
			sort : $(this).find('.sortdata').text(),
			enable : $(this).find('.enabledata').text()
		};
	});
	
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
				break;
				default :
					alert(me.alert.saveerror);
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
		data : ft.LoadForm('mydata'),
		submenu : []
	};
	
	$('.submenudata').each(function(i){
		myData.submenu[i] = {
			id : $(this).find('.iddata').text(),
			name : $(this).find('.namedata').text(),
			sort : $(this).find('.sortdata').text(),
			enable : $(this).find('.enabledata').text()
		};
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
			
			$('#lySubmenu').text('');	
			$(data.submenu).each(function(i, attr){
				me.AppendSubmenu({
					code : attr.code,
					no : i+1,
					id : attr.id,
					name : attr.name,
					sort : attr.sort,
					enable : attr.enable
				});
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
			
			$('#lyAddEdit input').first().focus();
			me.MsgInfo(me.alert.loadcomplete, 1);
		}
	});
};

me.AddSubmenu=function(){
	me.AppendSubmenu({
		code : new Date().getTime(),
		no : $('.submenudata').length+1,
		id : $('#sub_id').val(),
		name : $('#sub_name').val(),
		sort : $('#sub_sort').val(),
		enable : ft.GetRadio('sub_enable')
	});
	$('#ModalSubmenu input').val('');
	ft.SetRadio('sub_enable', 'Y');
	$('#ModalSubmenu').modal('hide');
};

me.AppendSubmenu=function(data){
	var html = '';
	html += '<tr id="submenu_{code}" class="submenudata">';
	html += '  <td class="center" class="descno">{no}</td>';
	html += '  <td class="iddata">{id}</td>';
	html += '  <td class="namedata">{name}</td>';
	html += '  <td class="sortdata center">{sort}</td>';
	html += '  <td class="enabledata center">{enable}</td>';
	html += '  <td class="center">';
	html += '    <button onclick="me.LoadSubmenu({code})" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</button>';
	html += '    <button onclick="me.RemoveSubmenu({code})" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Remove</button>';
	html += '  </td>';
	html += '</tr>';

	html = html.split('{code}').join(data.code);
	html = html.split('{no}').join(data.no);
	html = html.split('{id}').join(data.id);
	html = html.split('{name}').join(data.name);
	html = html.split('{sort}').join(data.sort);
	html = html.split('{enable}').join(data.enable);
	$('#lySubmenu').append(html);	
};

me.LoadSubmenu=function(code){
	$('#ModalSubmenu input').val('');
	ft.SetRadio('sub_enable', 'Y');
	
	var id = $('#submenu_'+code).find('.iddata').text();
	var name = $('#submenu_'+code).find('.namedata').text();
	var sort = $('#submenu_'+code).find('.sortdata').text();
	var enable = $('#submenu_'+code).find('.enabledata').text();
	
	$('#subeditid').text('#'+code);
	$('#sub_code').val(code);
	$('#sub_id').val(id);
	$('#sub_name').val(name);
	$('#sub_sort').val(sort);
	ft.SetRadio('sub_enable', enable);
	
	$('#btnAddSubmenu').css('display', 'none');
	$('#btnEditSubmenu').css('display', '');
	$('#ModalSubmenu').modal('show');
};

me.RemoveSubmenu=function(code){
	$('#submenu_'+code).remove();
};

me.EditSubmenu=function(){
	var code = $('#sub_code').val();
	var id = $('#sub_id').val();
	var name = $('#sub_name').val();
	var sort = $('#sub_sort').val();
	var enable = ft.GetRadio('sub_enable');
	
	$('#submenu_'+code).find('.iddata').text(id);
	$('#submenu_'+code).find('.namedata').text(name);
	$('#submenu_'+code).find('.sortdata').text(sort);
	$('#submenu_'+code).find('.enabledata').text(enable);
	
	$('#ModalSubmenu').modal('hide');
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
	me.ViewHeader();
	me.ViewSearch();
	me.SetDefaultSort();
	me.View();
	me.ShowIcon();
	me.SelectIcon();
});