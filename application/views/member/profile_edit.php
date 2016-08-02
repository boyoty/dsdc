<script type="text/javascript">
  $(document).ready(function(){
    $('#username').focus();
    $('#btn_submit').click(function(){
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/admin/person_profile_update',
        data:'person_id='+$('#person_id').val()+'&prename='+$('#prename').val()+'&name='+$('#name')+'&surname='+$('surname'),
        type:'POST',
        success:function(res){
          if(res=='true'){
            swal({
                  title : 'แสดงเมือทำงานสำเร็จ',
                  text : '',
                  type : 'success'
                  },
                  function(){
                    // เมื่อทำงานสำเร็จให้ไปที่หน้านี้
                    // window.location.replace("<?php echo base_url() ?>index.php/member");
                  }
              );

          }else{
            swal({
                  title : 'แสดงเมื่อทำงานไม่สำเร็จ',
                  text : '',
                  type : 'error'
              });
          }
        },
        error:function(err){
          swal({
                  title : 'เกิดข้อผิดพลาด',
                  text : err,
                  type : 'error'
              });
        }
      });
    });
  });
</script>
<div class="box box-success">
  <div class="box-header">
        <i class="fa fa-sign-in"></i>
    <h3 class="box-title"><?php echo $this->systemmodel->get_menuname($this->uri->segment(1) . '/' . $this->uri->segment(2)); ?></h3>
  </div>
  <div class="box-body">
    <form>
      <div class="form-group">
        <input type="hidden" name="person_id" id="person_id" value="<?php echo $this->session->person_id; ?>">
        <label for="prefix">คำนำหน้านาม</label>
        <input type="email" class="form-control" name="prefix" id="prefix" placeholder="คำนำหน้าชื่อ" value="<?php echo $data->prename; ?>" required>
      </div>
      <div class="form-group">
        <label for="name">ชื่อ</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ" value="<?php echo $data->name; ?>" required>
      </div>
      <div class="form-group">
        <label for="surname">สกุล</label>
        <input type="text" class="form-control" name="surname" id="surname" placeholder="สกุล" value="<?php echo $data->surname; ?>" required>
      </div>
      <div class="form-group has-feedback">
        <label for="password">รหัสผ่าน</label>
        <i class="fa fa-key form-control-feedback"></i>
          <input type="password" name="password" id='password' class="form-control" placeholder="Password">
        </div>
      <div class="form-group has-feedback">
        <label for="password">รหัสผ่าน(อีกครั้ง)</label>
        <i class="fa fa-key form-control-feedback"></i>
          <input type="password" name="password" id='password' class="form-control" placeholder="Password">
        </div>
      <div class="form-group">
        <label for="pic">ภาพประจำตัว</label>
        <input type="file" name="pic" id="pic">
        <p class="help-block">Example block-level help text here.</p>
      </div>
      <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-default">บันทึก</button>
    </form>
  </div>
</div>