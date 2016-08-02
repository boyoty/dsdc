<!-- iCheck -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte233/plugins/iCheck/square/blue.css">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?php echo $this->systemmodel->get_config("web_fname"); ?></b><?php echo $this->systemmodel->get_config("web_sname"); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body text-center bg-red">
    <br><br>
    <p class="login-box-msg"><h4><i class="fa fa-ban"></i>&nbsp;&nbsp;ขออภัย : ไม่ได้รับสิทธิ์ในการทำรายการ</h4></p>
    <br><br><br>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->