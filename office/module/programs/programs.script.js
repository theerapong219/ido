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
		{name:'code', display:'No', width:'100', align:'center', sort:false, search:false},
		{name:'id', display:'Quot No.'}
	]);
};

me.ViewSetHeader=function(obj){
	var html = '';
	var search = '';
	var showsearch = true;
	var showsort = true;
	var display = '';
	var width = '';
	var txtsort = '';
	var txtsearch = '';
	var visible = '';
	var item = {
		name : 'code',
		align : 'center'
	};

	$('#thView').text('');
	html = '<tr>';
	
	search = '<tr>';
	$.each(obj, function(i, attr){
		item = {
			name : '',
			align : ''
		};
		if(attr.display===undefined){
			display='';
		}else{
			display=attr.display;
		}
		if(attr.name===undefined){
			item.name = '';
		}else{
			item.name = attr.name;
		}
		if(attr.align===undefined){
			item.align = 'left';
		}else{
			item.align = attr.align;
		}
		if(attr.width===undefined){
			width='';
		}else{
			width='width="'+attr.width+'"';
		}
		if(attr.sort===undefined){
			showsort=true;
		}else{
			showsort=attr.sort;
		}
		if(attr.search===undefined){
			showsearch=true;
		}else{
			showsearch=attr.search;
		}
		
		me.viewcolumn[i] = item;
		
		if(showsort){
			txtsort = '<i onclick="me.ViewSort(this);" rel="'+attr.name+'" style="float:right; text-decoration:none;" class="sortdata fa fa-unsorted btn-link"></i>';
		}else{
			txtsort = '';
		}
		if(showsearch){
			txtsearch = '<input id="search_'+attr.name+'" name="'+attr.name+'" class="searchdata form-control" type="text" style="text-align:center; border:0; border-bottom:1px dotted #cccccc;" data-container="body" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" data-content="'+me.define.search+' '+display+'" />';
		}else{
			txtsearch = '&nbsp;';
		}
		
		if((i!=1) && (i!=2) && (i!=3) && (i!=10)){
			visible = 'visible-xs hidden-xs'
		}else{
			visible = ''
		}
		html += '<th class="center '+visible+'" '+width+'>'+display+txtsort+'</th>';
		search += '<th id="lysearch_'+attr.name+'" class="center '+visible+'" style="padding:3px;">'+txtsearch+'</th>';
	});
	html += '<th class="center" width="80"><span class="badge" id="ViewRecord"></span> '+me.define.record+'</th>';
	html += '</tr>';
	$('#thView').append(html);
	
	search += '<th class="center" style="padding:0;">';
	search += '<button type="submit" class="btn btn-info" style="margin:0;"><i class="fa fa-search"></i> '+me.define.search+'</button>';
	search += '</th>';
	search += '</tr>';
	$('#thView').append(search);
	
	var colspan = obj.length+1;
	var loading = '<tr>';
	loading += '<td style="text-align:center;" colspan="'+colspan+'">';
	loading += '<img src="../images/loading.gif" /> <span style="font-style:italic; color:#cccccc; font-size:14px;">Loading...</span>';
	loading += '</td>';
	loading += '</tr>';
	$('#thLoading').append(loading);
	
	$("[data-toggle=popover]").popover({
		container: "body"
	});
		
	$('.sortdata').first().addClass('fa-sort-asc').removeClass('fa-unsorted');
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
	$('#description').val('');
	$('#cost').val('');
	$('#price').val('');
	$('#lyDetail').text('');
	
	$('#lyPlan').css('display', 'block');
	$('#lyAuditor').css('display', 'none');
	$('#lyList').css('display', 'none');
};

me.ClearError=function(){
  $('#lyAddEdit .err').css('display', 'none');
	$('.form-group').removeClass('has-error');
};

me.CheckForm=function(){
	me.ClearError();
  return ft.CheckEmpty('empty');
};

me.AppendView=function(data){
	var html;
	$(data).each(function(i, field){
		html = '<tr id="tr'+field.code+'">';
		html += '<td class="" style="text-align:center">'+field.item[0]+'</td>';
		html += '<td class="visible-xs hidden-xs" style="text-align:center">'+field.item[1]+'</td>';
		html += '<td class="center" style="white-space:nowrap;">';
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
			me.MsgInfo(me.alert.loadcomplete, 1);
			$('#lyAddEdit input').first().focus();
			
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

			$('#lyDetail').text('');
			$(data.desc).each(function(i, attr){
				me.AppendDesc({
					code : attr.code,
					no : i+1,
					description : attr.description,
					cost : attr.cost,
					price : attr.price
				});
			});
		}
	});
};

me.LoadCbo=function(){
  $.getJSON(me.url+'?mode=LoadCbo&mod='+me.mod+'&'+new Date().getTime(), {}, function(data){
//    $.each(data.accr, function(i, result) {
//      $('<option>').attr('value', result.code).text(result.name).appendTo('#accr_code');
//    });
    $.each(data.audit, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#audit_code');
    });
    $.each(data.cus, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#cus_code');
    });
    $.each(data.emp, function(i, result) {
      $('<option>').attr('value', result.code).text(result.name).appendTo('#emp_code');
    });
	});
};

me.AddDesc=function(){
	me.AppendDesc({
		code : new Date().getTime(),
		no : $('.detaildata').length+1,
		description : $('#description').val(),
		cost : $('#cost').val(),
		price : $('#price').val()
	});
	$('#description').val('');
	$('#cost').val('');
	$('#price').val('');
};

me.AppendDesc=function(data){
	var html = '';
	html += '<tr id="detail_{code}" class="detaildata">';
	html += '  <td class="center" class="descno">{no}</td>';
	html += '  <td class="descdata">{description}</td>';
	html += '  <td class="right costdata">{cost}</td>';
	html += '  <td class="right pricedata">{price}</td>';
	html += '  <td class="center">';
	html += '    <button onclick="me.LoadDesc({code})" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</button>';
	html += '    <button onclick="me.DelDesc({code})" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Del</button>';
	html += '  </td>';
	html += '</tr>';

	html = html.split('{code}').join(data.code);
	html = html.split('{no}').join(data.no);
	html = html.split('{description}').join(data.description);
	html = html.split('{cost}').join(data.cost);
	html = html.split('{price}').join(data.price);
	$('#lyDetail').append(html);	
};

me.EditDesc=function(){
	var code = $('#desc_code').val();
	var desc = $('#description').val();
	var cost = $('#cost').val();
	var price = $('#price').val();
	
	$('#detail_'+code).find('.descdata').text(desc);
	$('#detail_'+code).find('.costdata').text(cost);
	$('#detail_'+code).find('.pricedata').text(price);
	
	$('#btnAddDesc').css('display', '');
	$('#btnEditDesc').css('display', 'none');
	$('#btnCancelDesc').css('display', 'none');
	
	$('#description').val('');
	$('#cost').val('');
	$('#price').val('');
	$('#desc_code').val('');
};

me.LoadDesc=function(code){
	var desc = $('#detail_'+code).find('.descdata').text();
	var cost = $('#detail_'+code).find('.costdata').text();
	var price = $('#detail_'+code).find('.pricedata').text();
	
	$('#description').val(desc);
	$('#cost').val(cost);
	$('#price').val(price);
	$('#desc_code').val(code);
	
	$('#btnAddDesc').css('display', 'none');
	$('#btnEditDesc').css('display', '');
	$('#btnCancelDesc').css('display', '');
};

me.CancelDesc=function(){
	$('#btnAddDesc').css('display', '');
	$('#btnEditDesc').css('display', 'none');
	$('#btnCancelDesc').css('display', 'none');
	
	$('#description').val('');
	$('#cost').val('');
	$('#price').val('');
};

me.DelDesc=function(code){
	$('#detail_'+code).remove();
};

me.SetLocalSearch=function(){
	$('#sortby').val('id');
	$('#search_date_select').addClass('dpk');
	$('#search_date_select2').addClass('dpk');
	$('#search_date_select').attr('placeholder', '00/00/0000');
	$('#search_date_select2').attr('placeholder', '00/00/0000');
	
	var cbo = '<select id="search_standard" name="standard" class="searchdata form-control"><option value=""></option><option value="6">6 เดือน</option><option value="12">12 เดือน</option></select>';
	$('#lysearch_standard').html(cbo);
	var cbo2 = '<select id="" name="" class="searchdata form-control"><option value="1">Approve</option><option value="2">Reject</option></select>';
	$('#lysearch_status').html(cbo2);
};

me.CusAdd=function(){
	$('#btnCusAdd').click(function(){
		window.location.href = 'app.php?mod=customers';
	});
};

me.LoadCustomer=function(){
	$('#cus_code').change(function(){
		$.ajax({
			url:me.url+'?mode=LoadCustomer&mod='+me.mod+'&'+new Date().getTime(),
			type:'POST',
			dataType:'json',
			data:{
				code : $(this).val()
			},
			success:function(data){
				$('#customer_en').val(data.name_en);
				$('#contact_en').val(data.contact_en);
				$('#address_en').val(data.address_en);
				
				$('#customer_th').val(data.name_th);
				$('#contact_th').val(data.contact_th);
				$('#address_th').val(data.address_th);
				
				$('#tel').val(data.tel);
				$('#mobile').val(data.mobile);
				$('#website').val(data.website);
				$('#fax').val(data.fax);
			}
		});
	});
};

me.Approve=function(code){
	if(!confirm('คุณต้องการอนุมัติรายการนี้ใช่หรือไม่ ?'))return;
};

me.Reject=function(code){
	if(!confirm('คุณไม่ต้องการอนุมัติรายการนี้ใช่หรือไม่ ?'))return;
	
};

me.OpenModalList=function(){
	$('#ModalList').modal('show');
};

me.OpenModalAuditor=function(){
	$('#ModalAuditor').modal('show');
};

me.OpenAuditor=function(){
	var slideWidth = $('#lyPlan').width();
	var slideHeight = $('#lyPlan').height();
	$('#plan').css({ width: slideWidth, height: slideHeight });
	
	$('#lyPlan').css('display', 'block');
	$('#lyAuditor').css('display', 'block');
	$('#lyList').css('display', 'none');
	$('#plan').animate({
			left: - slideWidth
	}, 300, function () {
			$('#lyPlan').appendTo('#plan');
			$('#plan').css('left', '');
			$('#lyPlan').css('display', 'none');
	});	
};

me.CloseAuditor=function(){
	var slideWidth = $('#lyPlan').width();
	
	$('#lyPlan').css('display', 'block');
	$('#lyAuditor').css('display', 'block');
	$('#lyList').css('display', 'none');
	$('#plan').animate({
			left: + slideWidth
	}, 300, function () {
			$('#lyAuditor').prependTo('#plan');
			$('#plan').css('left', '');
			$('#lyAuditor').css('display', 'none');
	});	
};

me.OpenList=function(){
	var slideWidth = $('#lyPlan').width();
	var slideHeight = $('#lyPlan').height();
	$('#plan').css({ width: slideWidth, height: slideHeight });
	
	$('#lyPlan').css('display', 'block');
	$('#lyAuditor').css('display', 'none');
	$('#lyList').css('display', 'block');
	$('#plan').animate({
			left: - slideWidth
	}, 300, function () {
			$('#lyPlan').appendTo('#plan');
			$('#plan').css('left', '');
			$('#lyPlan').css('display', 'none');
	});	
};

me.CloseList=function(){
	var slideWidth = $('#lyPlan').width();
	
	$('#lyPlan').css('display', 'block');
	$('#lyAuditor').css('display', 'none');
	$('#lyList').css('display', 'block');
	$('#plan').animate({
			left: + slideWidth
	}, 300, function () {
			$('#lyList').prependTo('#plan');
			$('#plan').css('left', '');
			$('#lyList').css('display', 'none');
	});	
};

me.OpenQuat=function(){
	$('#btnquat_id').click(function(){
		$('#ModalQuat').modal('show');
	});
};

/*================================================*\
  :: DEFAULT ::
\*================================================*/
$(document).ready(function(){
	me.SetUrl();
	me.ViewHeader();
	me.ViewSearch();
	me.View();
	me.SetLocalSearch();
	me.SetDateTime();
	me.SetDate();
	me.LoadCbo();
	me.CusAdd();
	me.LoadCustomer();
	me.TextEditorMin('detail');
	me.OpenQuat();
	$('.readonly').attr('readonly', true);
});