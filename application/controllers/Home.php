<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->member)) {
            redirect(base_url() . 'index.php/member');
        }
        //$this->load->library('grocery_CRUD');

    }

    public function index()
    {
        $data['content'] = 'home/login';
        $this->load->view('templates/index', $data);
    }

    public function loginfail()
    {
        $data['content'] = 'home/loginfail';
        $this->load->view('templates/index', $data);
    }

    public function register()
    {
        $data['content'] = 'home/register';
        $this->load->view('templates/index', $data);
    }

    public function register_post()
    {
        $this->load->model('HomeModel');
        $res = $this->HomeModel->checkusername_avaliable($this->input->post('username'));
        if ($res == true) {
            $this->HomeModel->register($this->input->post('person_id'), $this->input->post('username'), $this->input->post('password'));
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function login()
    {
        $this->load->model('HomeModel');
        $res = $this->HomeModel->checklogin($this->input->post('username'), $this->input->post('password'));
        if ($res != false) {
            $_SESSION['member']            = true;
            $_SESSION['username']          = $this->input->post('username');
            $_SESSION['person_id']         = $res;
            $person                        = $this->HomeModel->get_person_data($this->session->person_id);
            $_SESSION['name']              = $person->name . ' ' . $person->surname;
            $_SESSION['fullname']          = $person->prename . $person->name . ' ' . $person->surname;
            $_SESSION['department_id']     = $person->department;
            $department                    = $this->HomeModel->get_department_data($_SESSION['department_id']);
            $_SESSION['department_name']   = $department->department_name;
            $_SESSION['department_precis'] = $department->department_precis;
            $_SESSION['navname']           = $person->name . ' ' . $person->surname . ' | ' . $department->department_precis;
            $_SESSION['pic']               = $person->pic;
            // เก็บประวัติการใช้งาน
            $this->HomeModel->loginlog($this->session->person_id, $this->session->username);
            echo 'true';
        } else {
            $person = $this->HomeModel->get_person_data($this->input->post('username'));
            if ($person == false || $person->username != '') {
                echo 'false';
            } else {
                echo $this->input->post('username');
            }

        }
    }

}
