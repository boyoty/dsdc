<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function checklogin($username, $password)
    {
        $query = $this->db
            ->where('status', 1)
            ->where('username', $username)
            ->where('password', md5($password))
            ->get('person_main');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->person_id;
            }
            //rerurn $query->result();
        } else {
            return false;
        }
    }

    public function checkusername_avaliable($username)
    {
        $query = $this->db
            ->where('username', $username)
            ->get('person_main');
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function register($person_id, $username, $password)
    {
        $data = array('username' => $username, 'password' => md5($password));
        $this->db->where('person_id', $person_id);
        $this->db->update('person_main', $data);
    }

    public function get_person_data($person_id)
    {
        $query = $this->db
            ->where('person_id', $person_id)
            ->get('person_main');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_person_name($person_id)
    {
        $query = $this->db
            ->where('person_id="' . $person_id . '"')
            ->get('person_main');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $name = $row->name . ' ' . $row->surname;
                return $name;
            }
        } else {
            return false;
        }
    }

    public function get_department_data($department_id)
    {
        $query = $this->db
            ->where('department', $department_id)
            ->get('system_department');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_password($person_id)
    {
        $query = $this->db
            ->where('person_id', $person_id)
            ->get('person_main');
        if ($query->num_rows() == 1) {
            return $query->row->password;
        } else {
            return false;
        }
    }

    public function loginlog($personid, $username)
    {

        // Start Get
        $user_ipaddress = $_SERVER['REMOTE_ADDR'];
        $user_hostname  = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        // get os
        $user_agent  = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown";
        $os_array    = array(
            '/windows nt 10/i'      => 'Windows 10',
            '/windows nt 6.3/i'     => 'Windows 8.1',
            '/windows nt 6.2/i'     => 'Windows 8',
            '/windows nt 6.1/i'     => 'Windows 7',
            '/windows nt 6.0/i'     => 'Windows Vista',
            '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     => 'Windows XP',
            '/windows xp/i'         => 'Windows XP',
            '/windows nt 5.0/i'     => 'Windows 2000',
            '/windows me/i'         => 'Windows ME',
            '/win98/i'              => 'Windows 98',
            '/win95/i'              => 'Windows 95',
            '/win16/i'              => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i'        => 'Mac OS 9',
            '/linux/i'              => 'Linux',
            '/ubuntu/i'             => 'Ubuntu',
            '/iphone/i'             => 'iPhone',
            '/ipod/i'               => 'iPod',
            '/ipad/i'               => 'iPad',
            '/android/i'            => 'Android',
            '/blackberry/i'         => 'BlackBerry',
            '/webos/i'              => 'Mobile',
        );
        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {$os_platform = $value;}
        }
        $user_os = $os_platform;

        // get browser
        $user_agent    = $_SERVER['HTTP_USER_AGENT'];
        $browser       = "Unknown";
        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser',
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {$browser = $value;}
        }
        $user_browser = $browser;
        // End Get
        $data = array('personid' => $personid,
            'username'               => $username,
            'ipaddress'              => $user_ipaddress,
            'hostname'               => $user_hostname,
            'os'                     => $user_os,
            'browser'                => $user_browser,
        );
        $this->db->set('logintime', 'now()', false);
        $this->db->insert('system_loginlog', $data);

        // Insert to database
        //$strSQL = "INSERT INTO loginlog (personid, username, logintime, ipaddress, hostname, os, browser) VALUES ('$personid','$username', now(), '$user_ipaddress', '$user_hostname', '$user_os', '$user_browser')";
        //echo $strSQL;
        //$objDB = mysql_select_db($database_dbConnect);
        //$objQuery = mysql_query($strSQL);
    }

}
