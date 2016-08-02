<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Modulegroup extends CI_Controller
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

}
