<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // check login
        if (!isset($_SESSION['username'])) {
            redirect(base_url());
        }
        // end check login
        // check permission
        $res_permission = $this->systemmodel->get_menulink_permission($this->session->person_id);
        if (!in_array($this->uri->segment(1) . '/' . $this->uri->segment(2), $res_permission)) {
            redirect(base_url() . 'index.php/member/nopermission');
        }
        // end check permission
        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        $data = 'member/ready';
        $this->load->view('templates/index', $data);
        //$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
    }

    public function _example_output($output = null)
    {
        $data['content'] = 'system/grocery_crud';
        $data['output']  = $output;
        $this->load->view('templates/index', $data);
        //$this->load->view('system/menuView',$output);
    }

    public function system_menu()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_menu')
            ->set_subject('เมนู')
            ->columns('menu_id', 'menu_name', 'menu_link', 'module', 'menumember', 'menu_order', 'menu_statusid')
            ->display_as('menu_id', 'รหัสเมนู')
            ->display_as('menu_name', 'ชื่อเมนู')
            ->display_as('menu_link', 'controller/function')
            ->display_as('module', 'module')
            ->display_as('menu_order', 'ลำดับ')
            ->display_as('menumember', 'กลุ่มผู้ใช้งาน')
            ->display_as('menu_statusid', 'สถานะ');

        $crud->fields('menu_name', 'menu_link', 'module', 'menumember', 'menu_order', 'menu_statusid');
        $crud->required_fields('menu_name', 'menu_link', 'module', 'menu_statusid');
        $crud->set_primary_key('module', 'system_module');
        $crud->set_relation('module', 'system_module', 'module_desc');
        $crud->set_relation('menu_statusid', 'system_menu_status', 'menu_statusname');
        $crud->set_relation_n_n('menumember', 'system_menumember', 'person_group', 'menu_id', 'person_groupid', 'person_groupname', 'priority');

        //$crud->callback_add_field('menu_statusid',array($this,'add_field_callback_menu'));
        //$crud->callback_edit_field('menu_statusid',array($this,'edit_field_callback_menu'));

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function add_field_callback_menu()
    {
        return '<input type="radio" name="menu_statusid" value="1" checked>เปิด &nbsp;<input type="radio" name="menu_statusid" value="2">ปิด';
    }

    public function edit_field_callback_menu($value, $primary_key)
    {
        if ($value == 1) {
            return '<input type="radio" name="menu_statusid" value="1" checked>เปิด &nbsp;<input type="radio" name="menu_statusid" value="2">ปิด';
        } else {
            return '<input type="radio" name="menu_statusid" value="1">เปิด &nbsp;<input type="radio" name="menu_statusid" value="2" checked>ปิด';
        }
    }

    public function system_modulegroup()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_modulegroup')
            ->set_subject('กลุ่มโมดูล')
            ->columns('modulegroup', 'modulegroup_desc', 'modulegroup_icon', 'modulegroup_order')
            ->display_as('modulegroup', 'รหัสกลุ่มโมดูล')
            ->display_as('modulegroup_desc', 'ชื่อกลุ่มโมดูล')
            ->display_as('modulegroup_icon', 'ไอคอน')
            ->display_as('modulegroup_order', 'ลำดับ');

        $crud->fields('modulegroup_desc', 'modulegroup_icon', 'modulegroup_order');
        $crud->required_fields('modulegroup_desc');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function system_module()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('system_module')
            ->set_subject('โมดูลหลัก')
            ->columns('module', 'module_desc', 'workgroup', 'module_order', 'module_statusid')
            ->display_as('module', 'ชื่อ controller (ภาษาอังกฤษ)')
            ->display_as('module_desc', 'ชื่อโมดูลหลัก')
            ->display_as('workgroup', 'กลุ่มโมดูล')
            ->display_as('module_order', 'ลำดับ')
            ->display_as('module_statusid', 'สถานะ');

        $crud->fields('module', 'module_desc', 'workgroup', 'module_order', 'module_statusid');
        $crud->required_fields('module', 'module_desc', 'workgroup', 'module_statusid');

        $crud->set_relation('workgroup', 'system_modulegroup', 'modulegroup_desc');
        $crud->set_relation('module_statusid', 'system_module_status', 'module_statusname');

        //$crud->callback_add_field('module_active',array($this,'add_field_callback_module'));
        //$crud->callback_edit_field('module_active',array($this,'edit_field_callback_module'));

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function add_field_callback_module()
    {
        return '<input type="radio" name="module_active" value="1" checked>เปิด &nbsp;<input type="radio" name="module_active" value="2">ปิด';
    }

    public function edit_field_callback_module($value, $primary_key)
    {
        if ($value == 1) {
            return '<input type="radio" name="module_active" value="1" checked>เปิด &nbsp;<input type="radio" name="module_active" value="2">ปิด';
        } else {
            return '<input type="radio" name="module_active" value="1">เปิด &nbsp;<input type="radio" name="module_active" value="2" checked>ปิด';
        }
    }

    public function person_group()
    {
        $crud = new grocery_CRUD();

        //$crud->set_theme('bootstrap');
        $crud->set_table('person_group')
            ->set_subject('กลู่มผู้ใช้งาน')
            ->columns('person_groupid', 'person_groupname', 'person_grouporder')
            ->display_as('person_groupid', 'รหัสกลุ่มผู้ใช้งาน')
            ->display_as('person_groupname', 'กลู่มผู้ใช้งาน')
            ->display_as('person_grouporder', 'ลำดับ');

        $crud->fields('person_groupname', 'person_grouporder');
        $crud->required_fields('person_groupname', 'person_grouporder');

        $output = $crud->render();

        $this->_example_output($output);
    }

}
