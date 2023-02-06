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

    public function getServicio($servicio_id){
        $this->db->select('id, nombre');
        $this->db->from('servicios');
        $this->db->where('id', $servicio_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addServicio($data){
        $this->db->insert('servicios', $data);
    }

    public function updateServicio($id, $data){
        //query = "update servicios set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('servicios', $data))
            return true;
        else
            return false;
    }

    public function deleteServicio($id){
        //query = "delete from servicios where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('servicios'))
            return true;
        else
            return false;
    }
}
