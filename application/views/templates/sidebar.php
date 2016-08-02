  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php
if (isset($this->session->username)) {
    ?>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php
// get person picture
    $filename = 'assets/uploads/person/pic/' . $this->session->pic;
    if (($this->session->pic != '') && (file_exists($filename))) {
        $user_image = base_url() . $filename;
    } else {
        $user_image = base_url() . 'assets/uploads/person/pic/nopic.png';
    }
    // end get person picture
    ?>
          <img src="<?php echo $user_image; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->name; ?></p>
          <a href="#"><i class="fa fa-circle text-green"></i> ออนไลน์ | Online</a>
        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <?php }?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">เมนุหลัก</li>
        <?php
if (!isset($this->session->username)) {
    ?>
        <li>
          <a href="<?php echo base_url() ?>index.php/home">
            <i class="fa fa-user text-red"></i> <span>เข้าสู่ระบบ</span>
          </a>
        </li>
        <?php
} else {
    if ($this->uri->segment(1) == "member") {
        // แสดงกลุ่มโมดูล
        $res_modulegroup = $this->systemmodel->get_modulegroup();
        foreach ($res_modulegroup as $row_modulegroup) {
            $icon = 'fa-desktop';
            if ($row_modulegroup->modulegroup_icon != '') {$icon = $row_modulegroup->modulegroup_icon;}
            ?>
              <li>
                <a href="<?php echo base_url(); ?>index.php/modulegroup/index/<?php echo $row_modulegroup->modulegroup; ?>">
                  <i class="fa <?php echo $icon; ?>"></i> <span><?php echo $row_modulegroup->modulegroup_desc; ?></span>
                  <!--<small class="label pull-right bg-green">new</small>-->
                </a>
              </li>
             <?php
}
        // จบแสดงกลุ่มโมดูล
    } else
    if (($this->uri->segment(1) == "modulegroup") || ($this->uri->segment(1) != "")) {
        if ($this->uri->segment(1) != "modulegroup") {
            $modulegroup = $this->systemmodel->get_modulegroup_by_module($this->uri->segment(1));
        } else {
            $modulegroup = $this->uri->segment(3);
        }
        ?>
            <li>
              <a href="<?php echo base_url(); ?>index.php">
                <i class="fa fa-home"></i> <span>หน้าหลัก</span>
                <small class="label pull-right bg-green">กลับระบบหลัก</small>
              </a>
            </li>
            <?php
// แสดงโมดูล
        $res_module = $this->systemmodel->get_module($modulegroup);
        if ($res_module != false) {
            foreach ($res_module as $row_module) {
                // หาว่าในแต่ละโมดูลมีเมนูหรือไม่
                $res_menu = $this->systemmodel->get_menu($row_module->module);
                if ($res_menu != false) {
                    $active = '';
                    if ($row_module->module == $this->uri->segment(1)) {$active = 'active';}
                    ?>
                  <li class="<?php echo $active; ?> treeview">
                    <a href="#">
                      <i class="fa fa-th-list"></i> <span><?php echo $row_module->module_desc; ?></span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                    <?php
// แสดงเมนู
                    $res_permission = $this->systemmodel->get_menu_permission($this->session->person_id);
                    foreach ($res_menu as $row_menu) {
                        $uri_link = $this->uri->segment(1) . '/' . $this->uri->segment(2);
                        $active   = '';
                        if ($row_menu->menu_link == $uri_link) {$active = 'active';}

                        if (in_array($row_menu->menu_id, $res_permission)) {
                            $text_class = 'green';
                            $menu_link  = base_url() . 'index.php/' . $row_menu->menu_link;
                        } else {
                            $text_class = 'red';
                            $menu_link  = '#';
                        }
                        ?>
                        <li class="<?php echo $active; ?>"><a href="<?php echo $menu_link; ?>"><i class="fa fa-sign-in text-<?php echo $text_class ?>"></i> <?php echo $row_menu->menu_name; ?></a>
                        </li>
                      <?php
}
                    ?>
                    </ul>
                  </li>
                  <?php
}
            }
            // จบแสดงเมนู
        }
    }
    // จบแสดงโมดูล
    ?>

        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <small class="label pull-right bg-green">new</small>
          </a>
        </li>
        -->

        <?php }?>
        <?php if (!isset($this->session->member)) {?>
        <!-- แสดงเมนูที่ไม่ต้อง login -->
        <li class="header">คู่มือการใช้งาน</li>
        <li><a href="#"><i class="fa fa-book text-green"></i> <span>ลงทะเบียนผู้ใช้งาน</span></a></li>
        <li><a href="#"><i class="fa fa-book text-yellow"></i> <span>การเข้าสู่ระบบ</span></a></li>
        <li><a href="#"><i class="fa fa-book text-aqua"></i> <span>เปลี่ยนรหัสผ่าน</span></a></li>
        <?php }?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>