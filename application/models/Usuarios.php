<?php
class Usuarios extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUsuarios(){
        $this->db->select('id, nombre');
        $this->db->from('usuarios');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function addUsuario($data){
        $this->db->insert('usuarios', $data);
    }

}
