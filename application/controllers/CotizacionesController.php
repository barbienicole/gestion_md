<?php
class CotizacionesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Cotizaciones', 'modelo');
	}

    public function index(){
		$data['titulo'] = 'Proyectos';
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$this->load->view('cotizaciones/index', $data);
    }

    public function add(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
        $items = $this->modelo->getItems();
		$materiales = $this->modelo->getMateriales();
        $data = [
			'titulo' => 'Nuevo Proyecto',
			'iva' => $iva,
            'items' => $items
		];
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$data['materiales'] = $materiales;
		$this->load->view('cotizaciones/add', $data);
    }

    public function view(){
		$id = trim($this->input->get('id', TRUE));
		$cotizacion_cebecera = $this->modelo->obtenerCotizacion($id);
		$cotizacion_detalle_pre = $this->modelo->obtenerDetalleCotizacionPre($id);
		$cotizacion_detalle_real = $this->modelo->obtenerDetalleCotizacionReal($id);
		$cotizacion_material_pre = $this->modelo->obtenerCotizacionMaterialPre($id);
		$cotizacion_material_real = $this->modelo->obtenerCotizacionMaterialReal($id);
		$data['titulo'] = 'Ver Proyecto # '.$id;
		$data['cabecera'] = $cotizacion_cebecera; 
		$data['detalle_pre'] = $cotizacion_detalle_pre; 
		$data['detalle_real'] = $cotizacion_detalle_real; 
		$data['cotizacion_material_pre'] = $cotizacion_material_pre; 
		$data['cotizacion_material_real'] = $cotizacion_material_real; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$this->load->view('cotizaciones/view', $data);
    }

    public function edit(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
		$items = $this->modelo->getItems();
		$materiales = $this->modelo->getMateriales();
		$id = trim($this->input->get('id', TRUE));
		$cotizacion_cebecera = $this->modelo->obtenerCotizacion($id);
		$cotizacion_detalle_pre = $this->modelo->obtenerDetalleCotizacionPre($id);
		$cotizacion_detalle_real = $this->modelo->obtenerDetalleCotizacionReal($id);
		$cotizacion_material_pre = $this->modelo->obtenerCotizacionMaterialPre($id);
		$cotizacion_material_real = $this->modelo->obtenerCotizacionMaterialReal($id);
		$data['titulo'] = 'Editar Proyecto # '.$id;
		$data['cabecera'] = $cotizacion_cebecera; 
		$data['detalle_pre'] = $cotizacion_detalle_pre; 
		$data['detalle_real'] = $cotizacion_detalle_real; 
		$data['cotizacion_material_pre'] = $cotizacion_material_pre; 
		$data['cotizacion_material_real'] = $cotizacion_material_real; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['estados'] = $this->modelo->obtenerEstados();
		$data['iva'] = $iva;
		$data['items'] = $items;
		$data['materiales'] = $materiales;
		$this->load->view('cotizaciones/edit', $data);
    }

	public function obtenerCotizaciones(){
		$desde = trim($this->input->post('desde', TRUE));
		$hasta = trim($this->input->post('hasta', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$estado = trim($this->input->post('estado', TRUE));

		echo json_encode($this->modelo->obtenerCotizaciones($desde, $hasta, $cliente, $estado));
	}
	//add & edit
	//add
	public function addCotizacion(){
		$dataPre = $this->input->post('dataPre');
		$dataReal = $this->input->post('dataReal');
		$dataMaterialPre = $this->input->post('dataMaterialPre');
		$dataMaterialReal = $this->input->post('dataMaterialReal');

		$usuario = trim($this->input->post('usuario', TRUE));
		$codigo = trim($this->input->post('codigo', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$titulo = trim($this->input->post('titulo', TRUE));
		$estado = 1;
		$cliente = trim($this->input->post('cliente', TRUE));
		$descripcion = trim($this->input->post('descripcion', TRUE));
		$margen = trim($this->input->post('margen', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));
		$neto_pre = trim($this->input->post('neto_pre', TRUE));
		$iva_pre = trim($this->input->post('iva_pre', TRUE));
		$total_pre = trim($this->input->post('total_pre', TRUE));
		$neto_real = trim($this->input->post('neto_real', TRUE));
		$iva_real = trim($this->input->post('iva_real', TRUE));
		$total_real = trim($this->input->post('total_real', TRUE));

		$m_neto_pre = trim($this->input->post('m_neto_pre', TRUE));
		$m_iva_pre = trim($this->input->post('m_iva_pre', TRUE));
		$m_total_pre = trim($this->input->post('m_total_pre', TRUE));

		$m_neto_real = trim($this->input->post('m_neto_real', TRUE));
		$m_iva_real = trim($this->input->post('m_iva_real', TRUE));
		$m_total_real = trim($this->input->post('m_total_real', TRUE));

		$totales_presupuestado = $total_pre + $m_total_pre;
		$totales_real = $total_real + $m_total_real;
		$diferencia = $totales_presupuestado - $totales_real;

		$response = [];
		if(!empty($codigo) && !empty($fecha) && !empty($titulo) && !empty($cliente) && !empty($dataPre) && !empty($neto_pre) && !empty($margen)){
			//guardar cotizacion
			$dataCotizacion = 	[
				'codigo' => $codigo,
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha_actualizacion' => date('Y-m-d H:i:s'),
				'fecha' => $fecha,
				'titulo' => $titulo,
				'cotizaciones_estado_id' => $estado,
				'clientes_id' => $cliente,
				'descripcion' => $descripcion,
				'margen' => $margen,
				'iva_historico' => $iva_historico,
				'neto' => $neto_pre,
				'total' => $total_pre,
				'iva'	=>	$iva_pre,
				'neto_real' => $neto_real,
				'iva_real' => $iva_real,
				'total_real' => $total_real,

				'material_neto' => $m_neto_pre,
				'material_total' => $m_total_pre,
				'material_iva'	=>	$m_iva_pre,
				'material_neto_real' => $m_neto_real,
				'material_iva_real' => $m_iva_real,
				'material_total_real' => $m_total_real,

				'totales_presupuestado' => $totales_presupuestado,
				'totales_real' => $totales_real,
				'diferencia' => $diferencia,

				'usuarios_id' => $this->session->userdata("usuario_id")
			];

			$cotizacion_id = $this->modelo->modelo->add($dataCotizacion);
			//guardar detalles
			if($cotizacion_id != false){
				for($i=0; $i < count($dataPre); $i++){
					$arr_temp = 	[
								'cotizaciones_id' => $cotizacion_id,
								'items_id' => $dataPre[$i][0],
								'n_linea' => ($i+1),
								'cantidad' => $dataPre[$i][1],
								'valor'	=> $dataPre[$i][2]
					];
				
					$this->modelo->addDetallePre($arr_temp);
				}
				if(!empty($dataReal)){
					for($i=0; $i < count($dataReal); $i++){
						$arr_temp = 	[
									'cotizaciones_id' => $cotizacion_id,
									'items_id' => $dataReal[$i][0],
									'n_linea' => ($i+1),
									'cantidad' => $dataReal[$i][1],
									'valor'	=> $dataReal[$i][2]
						];
						$this->modelo->addDetalleReal($arr_temp);
					}
				}

				//guardar materiales
				if(!empty($dataMaterialPre)){
					for($i=0; $i < count($dataMaterialPre); $i++){
						$arr_temp = 	[
											'cotizacion_id' => $cotizacion_id,
											'material_id' => $dataMaterialPre[$i][0],
											'cantidad' => $dataMaterialPre[$i][1],
											'n_linea' => ($i+1),
											'valor'	=> $dataMaterialPre[$i][2]
						];
						$this->modelo->addMaterialPre($arr_temp);
					}
				}
				
				if(!empty($dataMaterialReal)){
					for($i=0; $i < count($dataMaterialReal); $i++){
						$arr_temp = 	[
											'cotizacion_id' => $cotizacion_id,
											'material_id' => $dataMaterialReal[$i][0],
											'cantidad' => $dataMaterialReal[$i][1],
											'n_linea' => ($i+1),
											'valor'	=> $dataMaterialReal[$i][2]
						];
						$this->modelo->addMaterialReal($arr_temp);
					}
				}
			}
			$response = [
							'codigo' => 1,
							'response' => 'Se ha generado de manera correcta el Proyecto.'
						];
		}
		else{
			$response = [
							'codigo' => 0,
							'response' => 'Verifique que los campos obligatorios no esten vacíos.'
						];
		}
		echo json_encode($response);
	}
	//edit
	public function editCotizacion(){
		$cotizacion_id = trim($this->input->post('cotizacion_id', TRUE));

		$dataPre = $this->input->post('dataPre');
		$dataReal = $this->input->post('dataReal');
		$dataMaterialPre = $this->input->post('dataMaterialPre');
		$dataMaterialReal = $this->input->post('dataMaterialReal');

		$usuario = trim($this->input->post('usuario', TRUE));
		$codigo = trim($this->input->post('codigo', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$titulo = trim($this->input->post('titulo', TRUE));
		$estado = trim($this->input->post('estado', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$descripcion = trim($this->input->post('descripcion', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));

		$neto_pre = trim($this->input->post('neto_pre', TRUE));
		$iva_pre = trim($this->input->post('iva_pre', TRUE));
		$total_pre = trim($this->input->post('total_pre', TRUE));
		$neto_real = trim($this->input->post('neto_real', TRUE));
		$iva_real = trim($this->input->post('iva_real', TRUE));
		$total_real = trim($this->input->post('total_real', TRUE));

		$m_neto_pre = trim($this->input->post('m_neto_pre', TRUE));
		$m_iva_pre = trim($this->input->post('m_iva_pre', TRUE));
		$m_total_pre = trim($this->input->post('m_total_pre', TRUE));

		$m_neto_real = trim($this->input->post('m_neto_real', TRUE));
		$m_iva_real = trim($this->input->post('m_iva_real', TRUE));
		$m_total_real = trim($this->input->post('m_total_real', TRUE));

		$totales_presupuestado = $total_pre + $m_total_pre;
		$totales_real = $total_real + $m_total_real;
		$diferencia = $totales_presupuestado - $totales_real;


		$response = [];
		if(!empty($codigo) && !empty($fecha) && !empty($titulo) && !empty($cliente) && 
			!empty($dataPre) && !empty($neto_pre)){
			//guardar cotizacion
			$dataCotizacion = 	[
									'codigo' => $codigo,
									'fecha_actualizacion' => date('Y-m-d H:i:s'),
									'fecha' => $fecha,
									'titulo' => $titulo,
									'cotizaciones_estado_id' => $estado,
									'clientes_id' => $cliente,
									'descripcion' => $descripcion,
									'iva_historico' => $iva_historico,
									'neto' => $neto_pre,
									'total' => $total_pre,
									'iva'	=>	$iva_pre,
									'neto_real' => $neto_real,
									'iva_real' => $iva_real,
									'total_real' => $total_real,

									'material_neto' => $m_neto_pre,
									'material_total' => $m_total_pre,
									'material_iva'	=>	$m_iva_pre,
									'material_neto_real' => $m_neto_real,
									'material_iva_real' => $m_iva_real,
									'material_total_real' => $m_total_real,

									'totales_presupuestado' => $totales_presupuestado,
									'totales_real' => $totales_real,
									'diferencia' => $diferencia,

									'usuarios_id' => $this->session->userdata("usuario_id")
								];
			
			$this->modelo->modelo->edit($dataCotizacion, $cotizacion_id);
			//eliminar detalles
			$this->modelo->deleteDetalleCotizacionPre($cotizacion_id);
			$this->modelo->deleteDetalleCotizacionReal($cotizacion_id);
			$this->modelo->deleteMaterialesPre($cotizacion_id);
			$this->modelo->deleteMaterialesReal($cotizacion_id);
			//guardar detalles
			if(!empty($dataPre)){
				for($i=0; $i < count($dataPre); $i++){
					$arr_temp = 	[
										'cotizaciones_id' => $cotizacion_id,
										'items_id' => $dataPre[$i][0],
										'n_linea' => ($i+1),
										'cantidad' => $dataPre[$i][1],
										'valor'	=> $dataPre[$i][2]
					];
					$this->modelo->addDetallePre($arr_temp);
				}
			}
			
			if(!empty($dataReal)){
				for($i=0; $i < count($dataReal); $i++){
					$arr_temp = 	[
										'cotizaciones_id' => $cotizacion_id,
										'items_id' => $dataReal[$i][0],
										'n_linea' => ($i+1),
										'cantidad' => $dataReal[$i][1],
										'valor'	=> $dataReal[$i][2]
					];
					$this->modelo->addDetalleReal($arr_temp);
				}
			}
			//guardar materiales
			if(!empty($dataMaterialPre)){
				for($i=0; $i < count($dataMaterialPre); $i++){
					$arr_temp = 	[
										'cotizacion_id' => $cotizacion_id,
										'material_id' => $dataMaterialPre[$i][0],
										'cantidad' => $dataMaterialPre[$i][1],
										'n_linea' => ($i+1),
										'valor'	=> $dataMaterialPre[$i][2]
					];
					$this->modelo->addMaterialPre($arr_temp);
				}
			}
			
			if(!empty($dataMaterialReal)){
				for($i=0; $i < count($dataMaterialReal); $i++){
					$arr_temp = 	[
										'cotizacion_id' => $cotizacion_id,
										'material_id' => $dataMaterialReal[$i][0],
										'cantidad' => $dataMaterialReal[$i][1],
										'n_linea' => ($i+1),
										'valor'	=> $dataMaterialReal[$i][2]
					];
					$this->modelo->addMaterialReal($arr_temp);
				}
			}

			$response = [
				'codigo' => 1,
				'response' => 'Se ha editado de manera correcta el Proyecto.'
			];
		}
		else{
			$response = [
				'codigo' => 0,
				'response' => 'Verifique que los campos obligatorios no esten vacíos.'
			];
		}
		echo json_encode($response);
	}

	public function historico()
	{
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_table('cotizaciones');
		$crud->set_subject('Usuario');
		$crud->set_language('spanish');

		$crud->set_relation('clientes_id','clientes','razonsocial');
		$crud->display_as('clientes_id','Cliente');
		$crud->display_as('total','Total P.');
		$crud->display_as('total_real','Total R.');
		$crud->display_as('fecha_creacion','creado');
		$crud->columns(['codigo','fecha','titulo', 'margen', 'totales_presupuestado','totales_real', 'diferencia','clientes_id', 'fecha_creacion']);
		/*
		$crud->set_relation('roles_id','roles','nombre');
		$crud->display_as('roles_id','Rol');

		$crud->field_type('password', 'password');
		$crud->field_type('email', 'email');
		
		$crud->unset_columns(array('password'));
		*/
		//$crud->unset_print();
		//$crud->unset_export();
		$crud->unset_clone();
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_read();

		$output = $crud->render();
		$data = (array)$output;
		$data['titulo'] = 'Cotizaciones Historico';
		$this->load->view('cotizaciones/historico', $data);
	}
}
