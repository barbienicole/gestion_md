<?php
class ServiciosFinalizados extends CI_Model {
    
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

    public function obtenerServiciosFinalizados($desde = null, $hasta = null, $cliente = null, $estado = null){
        $this->db->select('c.id, c.istt, c.fecha, c.servicio, c.cliente, c.valor, c.descripcion');
        $this->db->from('serviciosfinalizados as c');
        $this->db->join('serviciosfinalizados as ce', 'ce.id = c.serviciosfinalizados_id');
        $this->db->join('clientes as cli', 'cli.id = c.clientes_id');
        if(!empty($desde) && !empty($hasta)){
            $this->db->where('DATE(fecha) >= ', $desde);
            $this->db->where('DATE(fecha) <= ', $hasta);
        }
        if(!empty($cliente))
            $this->db->where('clientes_id', $cliente);
        if(!empty($estado))
            $this->db->where('serviciosfinalizados_id', $estado);
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
        $this->db->select('id, servicio');
        $this->db->from('serviciosfinalizados');
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

    public function obtenerServicioFinalizado($id){
        $this->db->select('c.id, c.istt, DATE(c.fecha) as fecha, c.servicio,
                            c.cliente, c.valor, c.descripcion');
        $this->db->from('serviciosfinalizados as c');
        $this->db->join('serviciosfinalizados as ce', 'ce.id = c.serviciosfinalizados_id');
        $this->db->join('clientes as cli', 'cli.id = c.clientes_id');
        $this->db->join('usuarios as u', 'u.id = c.usuarios_id');
        $this->db->where('c.id', $id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function obtenerDetalleServicioFinalizado($serviciofinalizado_id){
        $this->db->select('dc.id, dc.items_id as item_id, i.nombre as item_nombre, dc.n_linea, dc.cantidad, dc.valor');
        $this->db->from('detalle_serviciofinalizado as dc');
        $this->db->join('items as i', 'i.id = dc.items_id');
        $this->db->where('dc.serviciosfinalizados_id', $serviciofinalizado_id);
        return $this->db->get()->result_array();
    }

    public function add($data){
        if($this->db->insert('serviciosfinalizados', $data))
            return $this->db->insert_id();
        else
            return false;
    }

    public function addDetalle($data){
        if($this->db->insert('detalle_serviciofinalizado', $data))
            return true;
        else
            return false;
    }

    public function deleteDetalleServicioFinalizado($serviciofinalizado_id){
        $this->db->where('serviciosfinalizados_id', $serviciofinalizado_id);
        if($this->db->delete('detalle_serviciofinalizado'))
            true;
        else
            false;
    }


    public function edit($data, $id){
        $this->db->where('id', $id);
        if($this->db->update('serviciosfinalizados', $data))
            return true;
        else
            return false;
    }
}