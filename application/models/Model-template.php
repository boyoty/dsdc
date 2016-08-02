<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// เปลี่ยนชื่อโมเดล (MemberModel) ให้เป็นชื่อโมเดล อักษาตัวแรกให้เป็นตัวใหญ่และตามด้วยคำว่า Model
class MemberModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function example_model($username, $password)
    {
        // ตัวอย่างการใช้งานโมเดล
        $query = $this->db
            ->where('status', 1)
            ->where('username', $username)
            ->where('password', md5($password))
            ->get('person_main');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->person_id;
            }
        } else {
            return false;
        }
    }

}
