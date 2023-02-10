<?php
class Materiales extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getMateriales(){
        $this->db->select('id, codigo, nombre, modelo, valor, stock');
        $this->db->from('materiales');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getMaterial($material_id){
        $this->db->select('id, codigo, nombre, modelo, valor, stock');
        $this->db->from('materiales');
        $this->db->where('id', $material_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addMaterial($data){
        $this->db->insert('materiales', $data);
    }

    public function updateMaterial($id, $data){
        //query = "update materiales set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('materiales', $data))
            return true;
        else
            return false;
    }

    public function deleteMaterial($id){
        //query = "delete from materiales where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('materiales'))
            return true;
        else
            return false;
    }
}