<?php
class Configuraciones extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getConfiguraciones(){
        $this->db->select('id, nombre');
        $this->db->from('configuraciones');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getConfiguracion($configuracion_id){
        $this->db->select('id, nombre');
        $this->db->from('Configuraciones');
        $this->db->where('id', $configuracion_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addConfiguracion($data){
        $this->db->insert('configuraciones', $data);
    }

    public function updateConfiguracion($id, $data){
        //query = "update configuraciones set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('configuraciones', $data))
            return true;
        else
            return false;
    }

    public function deleteConfiguraciones($id){
        //query = "delete from configuraciones where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('configuraciones'))
            return true;
        else
            return false;
    }
}
