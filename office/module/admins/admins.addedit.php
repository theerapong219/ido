<?php $text = $lang[$mymenu['id']]; ?>
<h4 class="page-header">Information</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushSelect($text['prefix'], 'prefix', 'mydata', array('MR'=>'นาย', 'MRS'=>'นาง', 'MISS'=>'นางสาว'));
PushText($text['name'], 'name', 'mydata', '100');
PushText($text['surname'], 'surname', 'mydata', '100');
PushSelect($text['status'], 'status', 'mydata', array('S'=>'โสด', 'M'=>'สมรส', 'D'=>'หย่าร้าง'));
PushText($text['idcard'], 'idcard', 'mydata', '100');
PushText($text['idtax'], 'idtax', 'mydata', '100');
PushSelect($text['birthday'], 'birthday', 'mydata', LoadArrDay());
PushSelect($text['birthmonth'], 'birthmonth', 'mydata', LoadArrMonth());
PushSelect($text['birthyear'], 'birthyear', 'mydata', LoadArrYear(2470, 2600));
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText($text['id'], 'id', 'mydata', '100');
PushText($text['user_name'], 'user_name', 'mydata', '100');
PushText($text['user_pass'], 'user_pass', 'mydata', '100');
PushSelect($text['user_branch'], 'user_branch', 'mydata', array());
PushSelect($text['user_level'], 'user_level', 'mydata', array('1'=>'ผู้ใช้งาน', '2'=>'ผู้ดูแลระบบ'));
PushText($text['address'], 'address', 'mydata', '100');
PushText($text['province'], 'province', 'mydata', '100');
PushText($text['post'], 'post', 'mydata', '100');
PushText($text['phone'], 'phone', 'mydata', '100');
PushText($text['mobile'], 'mobile', 'mydata', '100');
PushText($text['email'], 'email', 'mydata', '100');
?>   
    </div>
  </div>
</div>

<h4 class="page-header">Image</h4>
<div class="row">
  <div class="col-md-12" role="form">
    <div id="uploader"></div> 
    
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="center"><?php echo $lang['image']['pic']; ?></th>
          <th class="center"><?php echo $lang['image']['name']; ?></th>
          <th class="center"><?php echo $lang['image']['size']; ?></th>
          <th class="center"><?php echo $lang['image']['default']; ?></th>
          <th class="center"><?php echo $lang['image']['del']; ?></th>
        </tr>
      </thead>
      <tbody id="tbImage">
      </tbody>
    </table>
  </div>
</div>
<br/>
<br/>
<br/>