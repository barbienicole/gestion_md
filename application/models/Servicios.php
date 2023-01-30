<?php
class Servicios extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getServicios(){
        $this->db->select('id, nombre');
        $this->db->from('servicios');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function addServicio($data){
        $this->db->insert('servicios', $data);
    }
}
