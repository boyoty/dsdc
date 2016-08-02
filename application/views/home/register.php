<script type="text/javascript">
  $(document).ready(function(){
    $('#username').focus();
    $('#btn_login').click(function(){
      //swal({  title : 'ข้อมูลไม่ถูกต้อง',
      //        text : 'ลงชื่อเข้าใช้เพื่อเข้าสู่ระบบ',
      //        type : 'error'});
      if($('#username').val().length < 4){
        swal({
          title : 'ข้อมูลไม่ถูกต้อง',
          text : 'username ต้องมากกว่า 4 ตัวอักษร',
          type : 'error'
        });
        return false;
      }
      if($('#password').val().length < 4){
        swal({
          title : 'ข้อมูลไม่ถูกต้อง',
          text : 'password ต้องมากกว่า 4 ตัวอักษร',
          type : 'error'
        });
        return false;
      }
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/home/register_post',
        data:'person_id='+$('#person_id').val()+'&username='+$('#username').val()+'&password='+$('#password').val(),
        type:'POST',
        success:function(res){
          if(res=='true'){
            swal({
              title : 'ลงทะเบียนเรียบร้อยแล้ว',
              text : 'ผู้ใช้สามารถเข้าสู่ระบบด้วย username และ password ที่กำหนด',
              type : 'success'
              },
              function(){
                window.location.replace("<?php echo base_url() ?>");
              }
            );
          }else{
            swal({
              title : 'กรุณากำหนด username ใหม่',
              text : 'username ซ้ำกับผู้ใช้อื่น',
              type : 'error'
              }
            );
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
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/plugins/iCheck/square/blue.css">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?php echo $this->systemmodel->get_config("web_fname"); ?></b><?php echo $this->systemmodel->get_config("web_sname"); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">ลงทะเบียนเพื่อกำหนด username และ password</p>

    <form action="<?php echo base_url(); ?>index.php/home/login" method="post">
      <div class="form-group has-feedback">
        <input type="hidden" name="person_id" id='person_id' class="form-control" placeholder="person_id" value="<?php echo $this->uri->segment(3); ?>">
        <input type="text" name="username" id='username' class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id='password' class="form-control" placeholder="Password" required>
        <i class="fa fa-key form-control-feedback"></i>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<a href="#">ลืมรหัสผ่าน</a><br>
          <a href="#" class="text-center">ลงทะเบียนผู้ใช้งาน</a>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="btn_login" class="btn btn-primary btn-block btn-flat">ลงทะเบียน</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->