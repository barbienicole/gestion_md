<?php
class Clientes extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getClientes(){
        $this->db->select('id, rut, nombre, razonsocial, telefono, email, direccion, comuna');
        $this->db->from('clientes');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getCliente($cliente_id){
        $this->db->select('id, rut, nombre, razonsocial, telefono, email, direccion, comuna');
        $this->db->from('clientes');
        $this->db->where('id', $cliente_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addCliente($data){
        $this->db->insert('clientes', $data);
    }

    public function updateCliente($id, $data){
        //query = "update clientes set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('clientes', $data))
            return true;
        else
            return false;
    }

    public function deleteCliente($id){
        //query = "delete from clientes where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('clientes'))
            return true;
        else
            return false;
    }
}
