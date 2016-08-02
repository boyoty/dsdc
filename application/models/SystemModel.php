<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SystemModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_config($configkey)
    {
        $query = $this->db
            ->where('configkey', $configkey)
            ->get('system_config');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->configvalue;
            }
        } else {
            return false;
        }
    }

    public function get_modulegroup()
    {
        $this->db->order_by('modulegroup_order');
        $query = $this->db->get('system_modulegroup');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_modulegroupname_by_id($modulegroup)
    {
        $this->db->where('modulegroup="' . $modulegroup . '"');
        $query = $this->db->get('system_modulegroup');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->modulegroup_desc;
            }
        } else {
            return false;
        }
    }

    public function get_modulegroupname_by_module($module)
    {
        $query = $this->db->query(' SELECT
                                    system_modulegroup.modulegroup_desc,
                                    system_module.module
                                    FROM
                                    system_module
                                    LEFT JOIN system_modulegroup
                                    ON system_module.workgroup = system_modulegroup.modulegroup
                                    WHERE system_module.module = "' . $module . '"');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->modulegroup_desc;
            }
        } else {
            return false;
        }
    }

    public function get_modulegroupicon_by_id($modulegroup)
    {
        $this->db->where('modulegroup="' . $modulegroup . '"');
        $query = $this->db->get('system_modulegroup');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->modulegroup_icon;
            }
        } else {
            return false;
        }
    }

    public function get_modulegroupicon_by_module($module)
    {
        $query = $this->db->query(' SELECT
                                    system_modulegroup.modulegroup_icon,
                                    system_module.module
                                    FROM
                                    system_module
                                    LEFT JOIN system_modulegroup
                                    ON system_module.workgroup = system_modulegroup.modulegroup
                                    WHERE system_module.module = "' . $module . '"');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->modulegroup_icon;
            }
        } else {
            return false;
        }
    }

    public function get_modulegroup_by_module($module)
    {
        $this->db->where('module="' . $module . '"');
        $query = $this->db->get('system_module');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->workgroup;
            }
        } else {
            return false;
        }
    }

    public function get_module($modulegroup)
    {
        $this->db->where('module_statusid=1');
        $this->db->where('workgroup=' . $modulegroup);
        $this->db->order_by('module_order');
        $query = $this->db->get('system_module');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_modulename($module)
    {
        $this->db->where('module="' . $module . '"');
        $query = $this->db->get('system_module');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->module_desc;
            }
        } else {
            return false;
        }
    }

    public function get_menu($module)
    {
        $this->db->where('menu_statusid=1');
        $this->db->where('module="' . $module . '"');
        $this->db->order_by('menu_order');
        $query = $this->db->get('system_menu');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_menuname($menu_link)
    {
        $this->db->where('menu_link="' . $menu_link . '"');
        $query = $this->db->get('system_menu');
        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                return $row->menu_name;
            }
        } else {
            return false;
        }
    }

    public function get_menu_permission($personid)
    {
        $query = $this->db->query('  SELECT DISTINCT
                            system_menumember.menu_id
                            FROM
                            system_menumember
                            INNER JOIN person_groupmember ON system_menumember.person_groupid = person_groupmember.person_groupid
                            WHERE
                            person_groupmember.person_id = "' . $personid . '"');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $arr[] = $row->menu_id;
            }
            return $arr;
        } else {
            return false;
        }
    }

    public function get_menulink_permission($personid)
    {
        $query = $this->db->query('  SELECT DISTINCT
                            system_menu.menu_link
                            FROM
                            system_menumember
                            INNER JOIN person_groupmember ON system_menumember.person_groupid = person_groupmember.person_groupid
                            INNER JOIN system_menu ON system_menumember.menu_id = system_menu.menu_id
                            WHERE
                            person_groupmember.person_id = "' . $personid . '"');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $arr[] = $row->menu_link;
            }
            return $arr;
        } else {
            return false;
        }
    }

}
