<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/plugins/iCheck/square/blue.css">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?php echo $this->systemmodel->get_config("web_fname"); ?></b><?php echo $this->systemmodel->get_config("web_sname"); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body text-center bg-red">
    <br><br>
    <p class="login-box-msg"><h4><i class="fa fa-ban"></i>&nbsp;&nbsp;ข้อมูลไม่ถูกต้อง</h4></p>
    <br>
    <div class="col-xs-6 col-xs-offset-3">
      <a class="btn btn-primary btn-block btn-flat" href="<?php echo base_url() ?>/index.php/home" role="button">ลงชื่อเข้าใช้อีกครั้ง</a>
    </div>
    <br><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->