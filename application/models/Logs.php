<?php
class Logs extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getLogs(){
        $this->db->select('id, nombre');
        $this->db->from('logs');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getLog($log_id){
        $this->db->select('id, nombre');
        $this->db->from('logs');
        $this->db->where('id', $log_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addLog($data){
        $this->db->insert('logs', $data);
    }

    public function updateLog($id, $data){
        //query = "update logs set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('logs', $data))
            return true;
        else
            return false;
    }

    public function deleteLog($id){
        //query = "delete from logs where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('logs'))
            return true;
        else
            return false;
    }
}
