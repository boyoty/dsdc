<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อคลาส (Name) ให้เป็นชื่อคอนโทรลเลอร์ อักษาตัวแรกให้เป็นตัวใหญ่
class Question extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // ตรวจสอบการเข้าสู่ระบบ ถ้ายังไม่เข้าสู่ระบบให้กลับไปที่หน้า login
        if (!isset($_SESSION['username'])) {
            redirect(base_url());
        }
        // จบ ตรวจสอบการเข้าสู่ระบบ
        // ตรวจสอบสิทธิ์การใช้งานเมนู
        $res_permission = $this->systemmodel->get_menulink_permission($this->session->person_id);
        if (!in_array($this->uri->segment(1) . '/' . $this->uri->segment(2), $res_permission)) {
            redirect(base_url() . 'index.php/member/nopermission');
        }
        // จบ ตรวจสอบสิทธิ์การใช้งานเมนู

        $this->load->library('grocery_CRUD');
    }

    public function index()
    {
        // หน้าแรกที่จะแสดงเมื่อเข้าสู่โมดูล
        $data = 'member/ready';
        // ส่งัวแปรหน้าแรกที่จะแสดงผลไปแสดงผลในไฟล์แทมเพลต
        $this->load->view('templates/index', $data);
    }

    public function _example_output($output = null)
    {
        // ส่วนแสดงผลใช้กับ grocery crud
        $data['content'] = 'system/grocery_crud';
        $data['output']  = $output;
        $this->load->view('templates/index', $data);
    }

    public function example_grocery_crud()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('tabelname')
            ->set_subject('ชื่อรายการ')
            ->columns('field1', 'field2')
            ->display_as('field1', 'ชื่1')
            ->display_as('field2', 'ชื่อ2');
        $crud->fields('field1', 'field2');
        $crud->required_fields('field1', 'field2');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function question_sheet()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('question_sheet')
            ->set_subject('ชุดแบบสอบถาม')
            ->columns('question_sheetid', 'question_sheetname','question_sheetorder', 'question_sheetstatusid')
            ->display_as('question_sheetid', 'รหัสชุด')
            ->display_as('question_sheetname', 'ชื่อชุดแบบสอบถาม')
            ->display_as('question_sheetstatusid', 'สถานะ')
            ->display_as('question_sheetorder', 'ลำดับที่');
        $crud->fields('question_sheetname','question_sheetorder', 'question_sheetstatusid');
        $crud->required_fields('question_sheetname','question_sheetorder', 'question_sheetstatusid');
        $crud->set_relation('question_sheetstatusid', 'question_sheetstatus', 'question_sheetstatusname');
        $output = $crud->render();
        $this->_example_output($output);
    }

    public function question()
    {
        // ตัวอย่างการใช้งาน grocery crud
        $crud = new grocery_CRUD();
        $crud->set_table('question')
            ->set_subject('คำถาม')
            ->columns('question_sheetid', 'question_name','question_typeid','question_order')
            ->display_as('question_id', 'รหัสคำถาม')
            ->display_as('question_sheetid', 'ชุดแบบสอบถาม')
            ->display_as('question_name', 'คำถาม')
            ->display_as('question_typeid', 'ประเภทคำตอบ')
            ->display_as('question_order', 'ลำดับที่');
        $crud->fields('question_sheetid','question_typeid','question_name','question_order');
        $crud->required_fields('question_sheetid','question_typeid','question_name','question_order');
        $crud->set_relation('question_sheetid', 'question_sheet', 'question_sheetname');
        $crud->set_relation('question_typeid', 'question_type', 'question_typename');
        $output = $crud->render();
        $this->_example_output($output);
    }

}
