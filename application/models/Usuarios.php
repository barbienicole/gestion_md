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

    public function getUsuario($usuario_id){
        $this->db->select('id, nombre');
        $this->db->from('usuarios');
        $this->db->where('id', $usuario_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addUsuario($data){
        $this->db->insert('usuarios', $data);
    }

    public function updateUsuario($id, $data){
        //query = "update usuarios set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('usuarios', $data))
            return true;
        else
            return false;
    }

    public function deleteUsuario($id){
        //query = "delete from usuarios where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('usuarios'))
            return true;
        else
            return false;
    }

}
