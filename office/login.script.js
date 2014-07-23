/*==================================================
*  Author : Tirapant Tongpann
*  Created Date : 14/6/2554 1:29
*  Module : Compile
*  Description : _FUNCTION_
*  Involve People : -
*  Last Updated : 14/6/2554 1:29
==================================================*/

/*==================================================
  :: METHOD ::
==================================================*/
var me={
  url:'login.inc.php'
};

me.Login=function(){
	$('#frmLogin').submit(function(){
		var myData = {
			user : $('#usernames').val(),
			pass : $('#passwords').val()
		};
		$.ajax({
			url:me.url+'?'+new Date().getTime(),
			type:'POST',
			dataType:'json',
			data:myData,
			success:function(data){
				switch(data.success){
					case 'COMPLETE' :
						window.location.href = data.url;
					break;
					default :
						alert('login error');
					break;
				}
			}
		});
	});
};

$(document).ready(function(){
	me.Login();
	$('#usernames').focus();
});








