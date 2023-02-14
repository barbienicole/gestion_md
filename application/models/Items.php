<?php
class Items extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getItems(){
        $this->db->select('id, nombre');
        $this->db->from('items');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }

    public function getItem($item_id){
        $this->db->select('id, nombre');
        $this->db->from('items');
        $this->db->where('id', $item_id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function addItem($data){
        $this->db->insert('items', $data);
    }

    public function updateItem($id, $data){
        //query = "update items set nombre = 'variable' where id = id_variable ";
        $this->db->where('id', $id);
        if($this->db->update('items', $data))
            return true;
        else
            return false;
    }

    public function deleteItem($id){
        //query = "delete from items where id = XXX";
        $this->db->where('id', $id);
        if($this->db->delete('items'))
            return true;
        else
            return false;
    }
}
