/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 14/6/2554 1:29
*  Module : Compile
*  Description : _FUNCTION_
*  Involve People : -
*  Last Updated : 14/6/2554 1:29
==================================================*/

/*==================================================
  :: VARIABLE ::
==================================================*/
var me={
	debug:[],
	site:'http://www.testdebug.com/qaic',
  url:'../main/module.inc.php',
	mod:'',
	lang:'TH',
	menu:'',
	submenu:'',
	task:'',
	code:'',
	sub:0,
	get:ft.GetParam(),
	viewcolumn:[],
	permission:{
		add:'',
		edit:'',
		del:''
	},
	define:{
		add : 'Add',
		edit : 'Edit',
		del : 'Del',
		clear : 'Clear',
		view : 'View',
		search : 'Search',
		record : 'Record',
		open : 'Open'
	},
	alert:{
		calladd : 'คุณต้องการเพิ่มข้อมูลใช่หรือไม่ ?',
		calledit : 'คุณต้องการแก้ไขข้อมูลใช่หรือไม่ ?',
		calldel : 'คุณต้องการลบข้อมูลใช่หรือไม่ ?',
		savecomplete : 'บันทึกข้อมูลเรียบร้อย',
		delcomplete : 'ลบข้อมูลเรียบร้อย',
		saveerror : 'บันทึกข้อมูลผิดพลาด',
		loadcomplete : 'โหลดข้อมูลเรียบร้อยแล้ว'
	}
};


/*==================================================
  :: METHOD ::
==================================================*/
me.Init=function(){
	me.task='ADD';
	me.Search();
	me.Limit();
	me.SetLoading();
	me.PutStar();
	
	$('#menu-'+me.menu).addClass('active');
	if(me.submenu != ''){
		$('#submenu-'+me.menu+'-'+me.submenu).addClass('active');
	}
	$('body').addClass("fixed_header");
	$('#MainContent').css('display', 'block');
	if($('#lyAddEdit input').first().hasClass('dpk')){
		
	}else if($('#lyAddEdit input').first().hasClass('dtpk')){
		
	}else if($('#lyAddEdit input').first().hasClass('tpk')){
		
	}else{
		$('#lyAddEdit input').first().focus();	
	}
};

me.ChangeLanguage=function(x){
	var myData={
		lang : x
	};
	
	$.ajax({
		url:'app.lang.php?'+new Date().getTime(),
		type:'GET',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					window.location.reload();
				break;
				default :
					alert('Change language error!!');
				break;
			}
		}
	});
};

me.SetUrl=function(){
	me.url = 'module/'+me.mod+'/'+me.mod+'.inc.php'
};

me.MsgInfo=function(msg, limit){
	if(limit === undefined)limit = 3;
	
	Messenger.options = {
		extraClasses: "messenger-fixed messenger-on-top messenger-on-right",
		theme: 'flat'
	}, Messenger().post({
		message: msg,
		type: "info",
		showCloseButton: !0,
		hideAfter: limit
	});	
};

me.MsgSuccess=function(msg, limit){
	if(limit === undefined)limit = 1;
	
	Messenger.options = {
		extraClasses: "messenger-fixed messenger-on-top messenger-on-right",
		theme: 'flat'
	}, Messenger().post({
		message: msg,
		type: "success",
		showCloseButton: !0,
		hideAfter: limit
	})	
};

me.MsgError=function(msg, limit){
	if(limit === undefined)limit = 2;
	
	Messenger.options = {
		extraClasses: "messenger-fixed messenger-on-top messenger-on-right",
		theme: 'flat'
	}, Messenger().post({
		message: msg,
		type: "error",
		showCloseButton: !0,
		hideAfter: limit
	})		
};

me.TextEditor=function(){
	var lang = 'en';
	if(me.lang == 'TH'){
		lang = 'th';
	}
	$('.editor').ckeditor({
		language: lang,
		skin : 'moonocolor'
	});
};

me.TextEditorMin=function(id){
	CKEDITOR.replace(id, {
		language: 'th',
		skin : 'moonocolor',
		toolbar: [
			{ name: 'tools', items: [ 'Maximize' ] },
			{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
//			{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
			{ name: 'others', items: [ '-' ] },
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] }
		]
	});
};

me.Zone=function(option){
	var zone = 'all';
	var search = true;
	var page = true;
	var status = true;
	var menu = true;
	
	if(option.zone !== undefined){
		zone = option.zone;
	}
	if(option.search !== undefined){
		search = option.search;
	}
	if(option.page !== undefined){
		page = option.page;
	}
	if(option.status !== undefined){
		status = option.status;
	}
	if(option.menu !== undefined){
		menu = option.menu;
	}
	
	if(zone=='left'){
		$('#lyAddEdit').css('display', 'none');
		$('#lyViewList').removeClass('col-md-4').addClass('col-md-12');
	}else if(zone=='right'){
		$('#lyViewList').css('display', 'none');
		$('#lyAddEdit').removeClass('col-md-8').addClass('col-md-12');
	}
	if(search){
		$('#cboSearch').css('display', '');
		$('#frmSearch').css('display', '');
	}else{
		$('#cboSearch').css('display', 'none');
		$('#frmSearch').css('display', 'none');
	}
	if(page){
		$('#RowPage').css('display', '');
		$('#lyPage').css('display', '');
	}else{
		$('#RowPage').css('display', 'none');
		$('#lyPage').css('display', 'none');
	}
	if(status){
		$('#HeadStatus').css('display', '');
		$('#lyStatus').css('display', '');
	}else{
		$('#HeadStatus').css('display', 'none');
		$('#lyStatus').css('display', 'none');
	}
	if(menu){
		$('#LocalMenu').css('display', '');
	}else{
		$('#LocalMenu').css('display', 'none');
	}
};

me.SetLoading=function(){
	$('#loading').ajaxStart(function(){
		$('.btn').attr('disabled', true);
	});
	$('#loading').ajaxStop(function(){
		$('.btn').attr('disabled', false);
	});
};

/*==================================================
  :: VIEW ::
==================================================*/
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
			txtsort = '<i id="sort_'+attr.name+'" onclick="me.ViewSort(this);" rel="'+attr.name+'" style="float:right; text-decoration:none;" class="sortdata fa fa-unsorted btn-link"></i>';
		}else{
			txtsort = '';
		}
		if(showsearch){
			txtsearch = '<input id="search_'+attr.name+'" name="'+attr.name+'" class="searchdata form-control" type="text" style="text-align:center; border:0; border-bottom:1px dotted #cccccc;" data-container="body" data-toggle="popover" data-placement="auto bottom" data-trigger="hover" data-content="'+me.define.search+' '+display+'" />';
		}else{
			txtsearch = '&nbsp;';
		}
		
		if(i>2){
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

me.ViewSetSearch=function(obj){
	$.each(obj, function(i, attr){
		$('<option>').attr('value', attr.name).text(attr.display).appendTo('#cboSearch');
	});
};

me.View=function(page){
	if(page===undefined)page=1;
	var myData = {
		sortby : $('#sortby').val(),
		sortorder : $('#sortorder').val(),
		limit : $('#cboLimit').val(),
		page : page,
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

me.AppendView=function(data){
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

me.AppendPage=function(data){
	$('#lyPage').text('');
	$('#lyPage').append('<li><a href="javascript:me.View('+data.fp+');"><i class="fa fa-step-backward"></i></a></li>');
	$('#lyPage').append('<li><a href="javascript:me.View('+data.pp+');"><i class="fa fa-backward"></i></a></li>');
	$(data.runpage).each(function(i, page){
		if(data.page == page){
			$('#lyPage').append('<li class="active"><a href="javascript:me.View('+page+');">'+page+'</a></li>');
		}else{
			$('#lyPage').append('<li><a href="javascript:me.View('+page+');">'+page+'</a></li>');
		}
	});
	$('#lyPage').append('<li><a href="javascript:me.View('+data.np+');"><i class="fa fa-forward"></i></a></li>');
	$('#lyPage').append('<li><a href="javascript:me.View('+data.ep+');"><i class="fa fa-step-forward"></i></a></li>');
};

me.Search=function(){
	$('#frmSearch').submit(function(){
		me.View();
		return false;
	});
};

me.Limit=function(){
	$('#cboLimit').change(function(){
		me.View();
	});
};

me.ViewList=function(){
	$('#tabviewlist').css('display', 'block');
	$('#tabaddedit').css('display', 'none');
	
	$('#toolview').css('display', 'block');
	$('#tooladd').css('display', 'none');
	$('#tooledit').css('display', 'none');
	me.View();
};

me.ViewSort=function(obj){
	var sortby = $(obj).attr('rel');
	var sortorder = '';
	if($(obj).hasClass('fa-unsorted')){
		sortorder = 'asc';
		$('.sortdata').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-unsorted');
		$(obj).addClass('fa-sort-asc').removeClass('fa-unsorted');
	}else if($(obj).hasClass('fa-sort-asc')){
		sortorder = 'desc';
		$('.sortdata').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-unsorted');
		$(obj).addClass('fa-sort-desc').removeClass('fa-unsorted');
	}else if($(obj).hasClass('fa-sort-desc')){
		sortorder = 'asc';
		$('.sortdata').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-unsorted');
		$(obj).addClass('fa-sort-asc').removeClass('fa-unsorted');
	}else{
		sortorder = 'asc';
		$('.sortdata').removeClass('fa-sort-asc').removeClass('fa-sort-desc').addClass('fa-unsorted');
		$(obj).addClass('fa-sort-asc').removeClass('fa-unsorted');
	}
	$('#sortby').val(sortby);
	$('#sortorder').val(sortorder);
	
	me.View();
};

me.ReView=function(){
	$('#sortby').val('code');
	$('#sortorder').val('asc');
	
	$('.sortdata').removeClass('btn-info').addClass('btn-link');
	$('.sortdata').first().addClass('btn-info').removeClass('btn-link');
	$('.searchdata').val('');
	
	me.View();
};

/*==================================================
  :: ADDEDIT ::
==================================================*/

me.New=function(){
	$('#tabviewlist').css('display', 'none');
	$('#tabaddedit').css('display', 'block');
	
	$('#tooladd').css('display', 'block');
	$('#tooledit').css('display', 'none');
	$('#toolview').css('display', 'none');
	$('#lyStatus').css('display', 'none');
	
	me.ClearData();
	me.task='ADD';
	$('#lyAddEdit input').first().focus();
};

me.Save=function(){
	if(me.task=='ADD'){
		me.Add();
	}else if(me.task=='EDIT'){
		me.Edit();
	}
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

me.Clear=function(){
	me.ClearData();
	me.task='ADD';
	$('#lyAddEdit input').first().focus();
};

me.Del=function(code, modedel){
	if(!confirm(me.alert.calldel))return;

	var myData = {
		code : code
	};	

	$.ajax({
		url:me.url+'?mode=Del&mod='+me.mod+'&'+new Date().getTime(),
		type:'POST',
		dataType:'json',
		data:myData,
		success:function(data){
			switch(data.success){
				case 'COMPLETE' :
					me.MsgSuccess(me.alert.delcomplete);
					if(modedel=='VIEW'){
						$('#tr'+code).remove();
					}else{
						me.ViewList();
					}
				break;
				default :
					alert(me.alert.saveerror);
				break;
			}
		}
	});
};

me.DelView=function(code){
	me.Del(code, 'VIEW');
};

me.DelEdit=function(){
	var code = $('#code').val();
	me.Del(code, 'EDIT');
};

me.SetDateTime=function(){
	var lang = 'uk';
	if(me.lang == 'TH'){
		lang = 'th';
	}
	$('.dtpk').datetimepicker({
		language: lang,
		format: 'dd/mm/yyyy hh:ii',
		pickerPosition: 'bottom-right',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	});
};

me.SetDate=function(){
	var lang = 'uk';
	if(me.lang == 'TH'){
		lang = 'th';
	}
	$('.dpk').datetimepicker({
		language: lang,
		format: 'dd/mm/yyyy',
		pickerPosition: 'bottom-right',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
};

me.SetTime=function(){
	var lang = 'uk';
	if(me.lang == 'TH'){
		lang = 'th';
	}
	$('.tpk').datetimepicker({
		language: lang,
		format: 'hh:ii',
		pickerPosition: 'bottom-right',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
	});
};

me.First=function(){
	var code = $('#firstcode').val();
	me.Load(code);
};

me.Prev=function(){
	var code = $('#prevcode').val();
	me.Load(code);
};

me.Next=function(){
	var code = $('#nextcode').val();
	me.Load(code);
};

me.Last=function(){
	var code = $('#lastcode').val();
	me.Load(code);
};

me.PutStar=function(){
	var self;
	var id = '';
	var text = '';
	$('.empty').each(function(){
		self = $(this);
		if((self.is('input:text')) || (self.is('input:password')) || (self.is('textarea')) || (self.is('select'))){
			id = $(this).attr('id');
			text = $('#lbl'+id).html()+'';
			text = text.split(' :').join('');
			$('#lbl'+id).html(text+' <b><font color="red">*</font></b> :');
		}
	});
};

/*================================================*\
  :: UPLOAD ::
\*================================================*/

me.SetUpload=function(){
	$("#uploader").pluploadQueue({
    runtimes : 'gears,html5,flash,silverlight,browserplus',
		url : 'app.upload.php?mod='+me.mod,
		max_file_size : '5mb',
		chunk_size : '1mb',
		unique_names : true,
		multi_selection: false,
		multiple_queues : true,
		filters : [
			{title : "Image files", extensions : "jpg,png,gif"}
		],

		init : {
			FilesAdded: function(up, files) {
				up.start();
			},

			FileUploaded: function(up, files, res){
//				ft.Debug(res.response);
				var obj = JSON.parse(res.response);
				if(obj.error != null){
					var err = obj.error;
					alert(err.message);
				}else{
					var rs = obj.result;
					$('#lyImage').text('');
					me.AppendImage(rs);
					$('#filepic').val(rs.id);
					$('#lyImageAdd').css('display', 'none');
					$('#lyImage').css('display', 'block');
					$('#boxUpload').modal('hide');
				}
			},

			UploadComplete: function(up, files) {
				up.splice();
			}
		}
	});	
};

me.SetUploadMulti=function(){
	$("#uploader").pluploadQueue({
    runtimes : 'gears,html5,flash,silverlight,browserplus',
		url : 'app.upload.php?mod='+me.mod,
		max_file_size : '5mb',
		chunk_size : '1mb',
		unique_names : true,
		multiple_queues : true,
		filters : [
			{title : "Image files", extensions : "jpg,png,gif"}
		],

		init : {
			FilesAdded: function(up, files) {
				up.start();
			},

			FileUploaded: function(up, files, res){
				var obj = JSON.parse(res.response);
				if(obj.error != null){
					var err = obj.error;
					alert(err.message);
				}else{
					var rs = obj.result;
					me.AppendUpload(rs);
				}
			},

			UploadComplete: function(up, files) {
				up.splice();
			}
		}
	});	
};

me.OpenUpload=function(){
	$('#boxUpload').modal('show');
};

me.AppendUpload=function(data){
  var html = '';
  html += '<tr class="imgdata" id="imgdata{id}" rel="{id}">';
  html += '  <td class="center"><a href="{url}" target="_blank"><img src="{thumb}" class="img-rounded" /></a></td>';
  html += '  <td class="imgid">{id}</td>';
  html += '  <td class="center">{del}</td>';
  html += '</tr>';

  html = html.split('{id}').join(data.id);
  html = html.split('{url}').join(data.url);
  html = html.split('{thumb}').join(data.thumb);
  html = html.split('{del}').join('<button type="button" type="button" onclick="me.DelUpload(\''+data.id+'\');" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>');
  $('#tbUpload').append(html);
};

me.DelUpload=function(id){
	$('#imgdata'+id).remove();
};

me.LoadImage=function(){
	var data = [];
	$('.imgid').each(function(i){
		data[i] = $(this).text();
	});
	me.AppendImageList(data);
	$('#tbUpload').text('');
	$('#boxUpload').modal('hide');
	
	if($('#filepic').val()==''){
		var filepic = $('.imgdata').first().text();
		$('#filepic').val(filepic);
		$('.pinimg').removeClass('colorblue');
		$('#pinimg_'+filepic).addClass('colorblue');
	}
};

me.AppendImage=function(data){
	var html = '';
	html += '<div id="img_{id}" class="col-md-3">';
	html += '  <div class="panel">';
	html += '    <div class="panel-heading">';
	html += '      <div class="panel-actions">';
	html += '        <a href="../img/{id}.jpg" target="_blank" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Open Image"><i class="fa fa-eye"></i></a>';
	html += '        <a href="javascript:me.OpenUpload();" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Edit Image"><i id="pinimg_{id}" class="pinimg fa fa-edit"></i></a>';
	html += '        <a href="javascript:me.DelImage();" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Delete Image"><i class="fa fa-trash-o"></i></a>';
	html += '      </div>';
	html += '      <h3 class="panel-title imgdata" style="width:100px; overflow:hidden; font-size:13px; font-weight:normal; padding:2px 0;">{id}</h3>';
	html += '    </div>';
	html += '    <div class="panel-body" style="margin:0 15px 15px 15px; padding:0; text-align:center; height:170px; overflow:hidden;">';
	html += '      <span class="item" style="width:100%; margin:0; padding:0;">';
	html += '				<img alt="200x200" src="../img/?pic={id}&w=200" style="position:static;">';
	html += '				<div class="details">';
	html += '					<a href="javascript:me.OpenImage(\'{id}\');" class="action"><i class="fa fa-arrows-alt"></i></a>';
	html += '				</div>';
	html += '      </span>';
	html += '    </div>';
	html += '  </div>';
	html += '</div>';	
	
	html = html.split('{id}').join(data.id);
	$('#lyImage').prepend(html);		
	
	$("[data-toggle=popover]").popover({
		container: "body"
	});	
};

me.AppendImageList=function(data){
	var html = '';
	html += '<div id="img_{id}" class="col-md-3">';
	html += '  <div class="panel">';
	html += '    <div class="panel-heading">';
	html += '      <div class="panel-actions">';
	html += '        <a href="javascript:me.ImgDefault(\'{id}\');" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Default Image"><i id="pinimg_{id}" class="pinimg fa fa-thumb-tack"></i></a>';
	html += '        <a href="../img/{id}.jpg" target="_blank" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Open Image"><i class="fa fa-eye"></i></a>';
	html += '        <a href="javascript:me.DelImageList(\'{id}\');" class="panel-action" data-container="body" data-toggle="popover" data-placement="auto top" data-trigger="hover" data-content="Delete Image"><i class="fa fa-trash-o"></i></a>';
	html += '      </div>';
	html += '      <h3 class="panel-title imgdata" style="width:100px; overflow:hidden; font-size:13px; font-weight:normal; padding:2px 0;">{id}</h3>';
	html += '    </div>';
	html += '    <div class="panel-body" style="margin:0 15px 15px 15px; padding:0; text-align:center; height:170px; overflow:hidden;">';
	html += '      <span class="item" style="width:100%; margin:0; padding:0;">';
	html += '				<img alt="200x200" src="../img/?pic={id}&w=200" style="position:static;">';
	html += '				<div class="details">';
	html += '					<a href="javascript:me.OpenImage(\'{id}\');" class="action"><i class="fa fa-arrows-alt"></i></a>';
	html += '				</div>';
	html += '      </span>';
	html += '    </div>';
	html += '  </div>';
	html += '</div>';	
	
	var temp = '';
	$(data).each(function(i, id){
		temp = html;
		temp = temp.split('{id}').join(id);
		$('#lyImage').prepend(temp);		
	});
	
	$("[data-toggle=popover]").popover({
		container: "body"
	});	
};

me.ImgDefault=function(id){
	$('#filepic').val(id);
	$('.pinimg').removeClass('colorblue');
	$('#pinimg_'+id).addClass('colorblue');
};

me.DelImage=function(){
	$('#lyImage').fadeOut('slow');
	
	setTimeout(function(){
		$('#lyImage').text('');
		$('#filepic').val('');
		$('#lyImageAdd').fadeIn('fast');
	}, 1000);
};

me.DelImageList=function(id){
	$('#img_'+id).fadeOut('slow');

	setTimeout(function(){
		$('#img_'+id).remove();

		var n=0;
		$('.pinimg').each(function(){
			n++;
		});

		if(n > 0){
			if($('#filepic').val() == id){
				var filepic = $('.imgdata').first().text();
				$('#filepic').val(filepic);
				$('.pinimg').removeClass('colorblue');
				$('#pinimg_'+filepic).addClass('colorblue');
			}
		}else{
			$('#filepic').val('');
		}
	}, 1000);
};

me.OpenImage=function(id){
	$('#ShowImageTitle').html('<a href="../img/'+id+'.jpg" target="_blank">'+id+'</a>');
	$('#ShowImage').html('<img src="../img/?pic='+id+'" style="width:100%">');
	$('#boxImage').modal('show');
};