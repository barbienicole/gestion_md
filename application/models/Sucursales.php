<?php
class Sucursales extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getSucursales(){
        $this->db->select('id, nombre');
        $this->db->from('sucursales');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getSucursal($sucursal_id){
        $this->db->select('id, nombre');
        $this->db->from('sucursales');
        $this->db->where('id', $sucursal_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addSucursal($data){
        $this->db->insert('sucursales', $data);
    }

    public function updateSucursal($id, $data){
        //query = "update sucursales set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('sucursales', $data))
            return true;
        else
            return false;
    }

    public function deleteSucursal ($id){
        //query = "delete from sucursales where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('sucursales'))
            return true;
        else
            return false;
    }
}