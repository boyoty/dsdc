<script type="text/javascript">
  $(document).ready(function(){
    $('#username').focus();
    $('#btn_login').click(function(){
      //swal({  title : 'ข้อมูลไม่ถูกต้อง',
      //        text : 'ลงชื่อเข้าใช้เพื่อเข้าสู่ระบบ',
      //        type : 'error'});
      $.ajax({
        url:'<?php echo base_url(); ?>index.php/home/login',
        data:'username='+$('#username').val()+'&password='+$('#password').val(),
        type:'POST',
        success:function(res){
          if(res=='true'){
            //swal({
                  //title : 'เข้าสู่ระบบแล้ว',
                  //text : res,
                  //type : 'success'
                  //},
                  //function(){
                    window.location.replace("<?php echo base_url() ?>index.php/member");
                  //}
              //);
          }else if(res=='false'){
            swal({
              title : 'ข้อมูลไม่ถูกต้อง',
              text : '',
              type : 'error'
            });
          }else{
            swal({
              title : 'เริ่มใช้ครั้งแรก',
              text : 'กรุณาลงทะเบียนเพื่อกำหนด username และ password',
              type : 'info'
              },
              function(){
                window.location.replace("<?php echo base_url() ?>index.php/home/register/"+res);
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
    <p class="login-box-msg">ลงชื่อเข้าใช้เพื่อเข้าสู่ระบบ</p>

    <form action="<?php echo base_url(); ?>index.php/home/login" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" id='username' class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id='password' class="form-control" placeholder="Password">
        <i class="fa fa-key form-control-feedback"></i>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!--<a href="#">ลืมรหัสผ่าน</a><br>
          <a href="#" class="text-center">ลงทะเบียนผู้ใช้งาน</a>-->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" id="btn_login" class="btn btn-primary btn-block btn-flat">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->