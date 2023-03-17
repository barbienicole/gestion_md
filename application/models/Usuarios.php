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

    public function login($usuario, $password){
        $this->db->select(
                            'u.id as id, u.usuario as usuario, u.password as password, 
                            u.nombre as nombre, u.email as email, u.roles_id as roles_id, 
                            u.escribir as escribir, u.editar as editar, u.eliminar as eliminar, r.nombre as roles_nombre'
                        );
        $this->db->from('usuarios as u');
        $this->db->join('roles as r', 'r.id = u.roles_id');
        $this->db->where('u.usuario', $usuario);
        $this->db->where('u.password', $password);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addLog($data){
        $this->db->insert('logs', $data);
    }

}
