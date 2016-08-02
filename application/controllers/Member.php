<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->member)) {
            redirect(base_url());
        }
        //$this->load->library('grocery_CRUD');

    }

    public function index()
    {
        $data['content'] = 'member/ready';
        $this->load->view('templates/index', $data);
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url());
    }

    public function nopermission()
    {
        $data['content'] = 'member/nopermission';
        $this->load->view('templates/index', $data);
    }

}
