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

    public function obtenerCotizaciones($desde = null, $hasta = null, $cliente = null, $estado = null){
        $this->db->select('c.id, c.codigo, c.fecha_creacion, c.titulo, cli.razonsocial as cliente, c.total, c.total_real, (c.total - c.total_real) as diferencia, ce.nombre as estado');
        $this->db->from('cotizaciones as c');
        $this->db->join('cotizaciones_estado as ce', 'ce.id = c.cotizaciones_estado_id');
        $this->db->join('clientes as cli', 'cli.id = c.clientes_id');
        if(!empty($desde) && !empty($hasta)){
            $this->db->where('fecha_creacion >= ', $desde);
            $this->db->where('fecha_creacion <= ', $hasta);
        }
        if(!empty($cliente))
            $this->db->where('clientes_id', $cliente);
        if(!empty($estado))
            $this->db->where('cotizaciones_estado_id', $estado);
        $this->db->order_by('fecha_creacion DESC');
        return $this->db->get()->result_array();
    }

    public function obtenerClientes(){
        $this->db->select('id, rut, razonsocial');
        $this->db->from('clientes');
        $this->db->order_by('razonsocial ASC');
        return $this->db->get()->result_array();
    }

    public function obtenerEstados(){
        $this->db->select('id, nombre');
        $this->db->from('cotizaciones_estado');
        $this->db->order_by('id ASC');
        return $this->db->get()->result_array();
    }

    public function getParametroConfiguracion($parametro){
        $this->db->select('valor');
        $this->db->from('configuraciones');
        $this->db->where('parametro', $parametro);
        $this->db->limit(1);
        $res = $this->db->get()->result_array();
        return ( !empty($res[0]['valor']) ? $res[0]['valor'] : 0.19 );
    }
}
