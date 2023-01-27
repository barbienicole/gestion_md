<?php
class Roles extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getRoles(){
        $this->db->select('id, nombre');
        $this->db->from('roles');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function addRol($data){
        $this->db->insert('roles', $data);
    }
}
