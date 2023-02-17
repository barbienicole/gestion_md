<?php
class Cotizaciones extends CI_Model {
    
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
}
