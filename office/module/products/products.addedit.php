<?php
$text['id'] = 'รหัส';
$text['name'] = 'ชื่อ';
$text['type_code'] = 'กลุ่มสินค้า';
$text['cat_code'] = 'ประเภทสินค้า';
$text['promotion'] = 'โปรโมชั่น';
$text['brand_code'] = 'ยี่ห้อ';
$text['shortcontent'] = 'เนื้อหาย่อ';
$text['content'] = 'เนื้อหาหลัก';
$text['cost'] = 'ราคาสมาชิก';
$text['price'] = 'ราคาขาย';
$text['point'] = 'แต้ม';
$text['quantity'] = 'ปริมาณคงเหลือ';
$text['unit_code'] = 'หน่วยสินค้า';
$text['filepic'] = 'รูปหลัก';
?>
<h4 class="page-header"><i class="fa fa-list-ul"></i> ข้อมูล</h4>
<div class="row">
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText($text['id'], 'id', 'mydata empty', '30');
PushText($text['name'], 'name', 'mydata empty', '100');
PushSelect($text['type_code'], 'type_code', 'mydata empty');
PushSelect($text['cat_code'], 'cat_code', 'mydata empty');
PushCheckbox($text['promotion'], 'promotion', 'mydata');
PushSelect($text['brand_code'], 'brand_code', 'mydata empty');
PushText($text['filepic'], 'filepic', 'mydata', '100');
?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-horizontal" role="form">
<?php
PushText($text['cost'], 'cost', 'num2 mydata empty', '10');
PushText($text['price'], 'price', 'num2 mydata empty', '10');
PushText($text['point'], 'point', 'num mydata empty', '10');
PushText($text['quantity'], 'quantity', 'num mydata', '10');
PushSelect($text['unit_code'], 'unit_code', 'mydata empty');
?>      
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="form-horizontal" role="form">
<?php
PushTextArea($text['shortcontent'], 'shortcontent', 'mydata', 5, 2);
PushTextEditor($text['content'], 'content', 'mydata editor');
?>
    </div>
  </div>
</div>
<br/>
<br/>

<h4 class="page-header"><i class="fa fa-picture-o"></i> รูปภาพ</h4>
<div class="row">
  <div class="col-md-3">
    <div class="panel" style="background-color:#F7FAFC; border-style:dashed;">
      <div class="panel-body" style="margin-top:0; padding:95px 0 91px 0; text-align:center;">
        <button type="button" class="btn btn-primary btn-lg" onclick="me.OpenUpload();"><i class="fa fa-plus"></i> เพิ่มรูปภาพ</button>
      </div>
    </div>
  </div>  
  
  <span id="lyImage"></span>
  
  <div class="col-md-12" role="form" style="display:none;">
    <div align="right">
      <button type="button" class="btn btn-primary" onclick="me.OpenUpload();"><i class="fa fa-plus"></i> เพิ่มรูปภาพ</button>
    </div>
    <br/>
  </div>
</div>

<div class="modal fade" id="boxUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Upload</h4>
      </div>
      <div class="modal-body" id="">
        <div id="uploader"></div> 
    
        <br/>
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th class="center" width="70">รูป</th>
              <th class="center">ชื่อ</th>
              <th class="center" width="50">ลบ</th>
            </tr>
          </thead>
          <tbody id="tbUpload">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="me.LoadImage();"><i class="fa fa-check"></i> ยืนยัน</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<br/>
<br/>
