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
        $this->db->select('c.id, c.codigo, c.fecha_creacion, c.titulo, 
        cli.razonsocial as cliente, c.total, c.total_real, (c.total - c.total_real) as diferencia2, ce.nombre as estado, 
        material_neto_real, material_iva_real, material_total_real, 
        material_neto, material_iva, material_total, margen, totales_presupuestado, totales_real, diferencia');
        $this->db->from('cotizaciones as c');
        $this->db->join('cotizaciones_estado as ce', 'ce.id = c.cotizaciones_estado_id');
        $this->db->join('clientes as cli', 'cli.id = c.clientes_id');
        if(!empty($desde) && !empty($hasta)){
            $this->db->where('DATE(fecha_creacion) >= ', $desde);
            $this->db->where('DATE(fecha_creacion) <= ', $hasta);
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

    public function obtenerCotizacion($id){
        $this->db->select('c.id, c.codigo, DATE(c.fecha_creacion) as fecha_creacion, c.titulo,
                            c.descripcion, c.neto as neto_pre, c.iva as iva_pre, c.iva_historico, c.total as total_pre, 
                            DATE(c.fecha_actualizacion) as fecha_actualizacion, u.nombre as usuario_nombre, cli.razonsocial, c.neto_real, c.iva_real,
                            c.total_real, ce.nombre as estado, cli.id as cliente_id, ce.id as estado_id, 
                            material_neto_real, material_iva_real, material_total_real, 
                            material_neto, material_iva, material_total, margen, totales_presupuestado, totales_real, diferencia');
        $this->db->from('cotizaciones as c');
        $this->db->join('cotizaciones_estado as ce', 'ce.id = c.cotizaciones_estado_id');
        $this->db->join('clientes as cli', 'cli.id = c.clientes_id');
        $this->db->join('usuarios as u', 'u.id = c.usuarios_id');
        $this->db->where('c.id', $id);
        $this->db->limit(1);
        return $this->db->get()->result_array();
    }

    public function obtenerDetalleCotizacionPre($cotizacion_id){
        $this->db->select('dc.id, dc.items_id as item_id, i.nombre as item_nombre, dc.n_linea, dc.cantidad, dc.valor');
        $this->db->from('detalle_cotizacion as dc');
        $this->db->join('items as i', 'i.id = dc.items_id');
        $this->db->where('dc.cotizaciones_id', $cotizacion_id);
        return $this->db->get()->result_array();
    }

    public function obtenerDetalleCotizacionReal($cotizacion_id){
        $this->db->select('dc.id, dc.items_id as item_id, i.nombre as item_nombre, dc.n_linea, dc.cantidad, dc.valor');
        $this->db->from('detalle_cotizacion_real as dc');
        $this->db->join('items as i', 'i.id = dc.items_id');
        $this->db->where('dc.cotizaciones_id', $cotizacion_id);
        return $this->db->get()->result_array();
    }

    public function add($data){
        if($this->db->insert('cotizaciones', $data))
            return $this->db->insert_id();
        else
            return false;
    }

    public function addDetallePre($data){
        if($this->db->insert('detalle_cotizacion', $data))
            return true;
        else
            return false;
    }

    public function addDetalleReal($data){
        if($this->db->insert('detalle_cotizacion_real', $data))
            return true;
        else
            return false;
    }

    public function deleteDetalleCotizacionPre($cotizacion_id){
        $this->db->where('cotizaciones_id', $cotizacion_id);
        if($this->db->delete('detalle_cotizacion'))
            true;
        else
            false;
    }

    public function deleteDetalleCotizacionReal($cotizacion_id){
        $this->db->where('cotizaciones_id', $cotizacion_id);
        if($this->db->delete('detalle_cotizacion_real'))
            true;
        else
            false;
    }

    public function edit($data, $id){
        $this->db->where('id', $id);
        if($this->db->update('cotizaciones', $data))
            return true;
        else
            return false;
    }

    public function obtenerCotizacionMaterialPre($cotizacion_id){
        $this->db->select('cm.cantidad, m.codigo, m.nombre, m.id as material_id, cm.n_linea as n_linea, cm.valor as valor');
        $this->db->from('cotizacion_material_presupuestado as cm');
        $this->db->join('materiales as m', 'm.id = cm.material_id');
        $this->db->where('cm.cotizacion_id', $cotizacion_id);
        return $this->db->get()->result_array();
    }

    public function obtenerCotizacionMaterialReal($cotizacion_id){
        $this->db->select('cm.cantidad, m.codigo, m.nombre, m.id as material_id, cm.n_linea as n_linea, cm.valor as valor');
        $this->db->from('cotizacion_material_real as cm');
        $this->db->join('materiales as m', 'm.id = cm.material_id');
        $this->db->where('cm.cotizacion_id', $cotizacion_id);
        return $this->db->get()->result_array();
    }

    public function deleteMaterialesPre($cotizacion_id){
        $this->db->where('cotizacion_id', $cotizacion_id);
        if($this->db->delete('cotizacion_material_presupuestado'))
            true;
        else
            false;
    }

    public function deleteMaterialesReal($cotizacion_id){
        $this->db->where('cotizacion_id', $cotizacion_id);
        if($this->db->delete('cotizacion_material_real'))
            true;
        else
            false;
    }

    public function addMaterialPre($data){
        if($this->db->insert('cotizacion_material_presupuestado', $data))
            return true;
        else
            return false;
    }

    public function addMaterialReal($data){
        if($this->db->insert('cotizacion_material_real', $data))
            return true;
        else
            return false;
    }

    public function getMateriales(){
        $this->db->select('id, codigo,  nombre, valor');
        $this->db->from('materiales');
        $this->db->order_by('nombre','asc');
        return $this->db->get()->result_array();
    }
}
