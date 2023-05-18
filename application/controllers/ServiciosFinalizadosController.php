<?php
class ServiciosFinalizadosController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('ServiciosFinalizados', 'modelo');
	}

    public function index(){
		$data['titulo'] = 'Servicios Técnicos Finalizados';
		$data['clientes'] = $this->modelo->obtenerClientes();
        $data['servicios'] = $this->modelo->obtenerServicios();
		$this->load->view('serviciosfinalizados/index', $data);
    }

    public function add(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
        $data = [
			'titulo' => 'Nuevo Servicio Técnico',
			'iva' => $iva,
		];
		$data['clientes'] = $this->modelo->obtenerClientes();
        $data['servicios'] = $this->modelo->obtenerServicios();
		$this->load->view('serviciosfinalizados/add', $data);
    }

    public function view(){
		$id = trim($this->input->get('id', TRUE));
		$serviciofinalizado_cebecera = $this->modelo->obtenerServicioFinalizado($id);
		$serviciofinalizado_detalle = $this->modelo->obtenerDetalleServicioFinalizado($id);
		$data['titulo'] = 'Ver Servicio Cerrado # '.$id;
		$data['cabecera'] = $serviciofinalizado_cebecera; 
		$data['detalle'] = $serviciofinalizado_detalle; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$this->load->view('serviciosfinalizados/view', $data);
    }

    public function edit(){
		$iva = $this->modelo->getParametroConfiguracion('iva');
		$id = trim($this->input->get('id', TRUE));
		$serviciofinalizado_cebecera = $this->modelo->obtenerServicioFinalizado($id);
		$serviciofinalizado_detalle = $this->modelo->obtenerDetalleServicioFinalizado($id);
		$data['titulo'] = 'Editar Proyecto # '.$id;
		$data['cabecera'] = $serviciofinalizado_cebecera; 
		$data['detalle'] = $serviciofinalizado_detalle; 
		$data['clientes'] = $this->modelo->obtenerClientes();
		$data['iva'] = $iva;
		$this->load->view('serviciosfinalizados/edit', $data);
    }

	public function obtenerServiciosFinalizados(){
		$desde = trim($this->input->post('desde', TRUE));
		$hasta = trim($this->input->post('hasta', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));

		echo json_encode($this->modelo->obtenerServiciosFinalizados($desde, $hasta, $cliente));
	}
	//add & edit
	//add
	public function addServicioFinalizado(){
		$data = $this->input->post('data', TRUE);

		$usuario = trim($this->input->post('usuario', TRUE));
		$ticket = trim($this->input->post('ticket', TRUE));
		$istt = trim($this->input->post('istt', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$servicio = trim($this->input->post('servicio', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
		$valor = trim($this->input->post('valor', TRUE));
        $descripcion = trim($this->input->post('descripcion', TRUE));
		$nota_venta = trim($this->input->post('nota_venta', TRUE));
		$orden_compra = trim($this->input->post('orden_compra', TRUE));
		$factura = trim($this->input->post('factura', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));
		$iva = trim($this->input->post('iva', TRUE));
		$total = trim($this->input->post('total', TRUE));


		$response = [];
		if(!empty($istt) && !empty($fecha) && !empty($servicio)){
			//guardar serviciofinalizado
			$dataServicioFinalizado = 	[
				'ticket' => $ticket,
				'istt' => $istt,
				'fecha_creacion' => date('Y-m-d H:i:s'),
				'fecha' => $fecha,
				'servicio' => $servicio,
				'clientes_id' => $cliente,
				'valor' => $valor,
                'descripcion' => $descripcion,
				'nota_venta' => $nota_venta,
				'orden_compra' => $orden_compra,
				'factura' => $factura,
				'iva_historico' => $iva_historico,
				'total' => $total,
				'iva'	=>	$iva,
				'usuarios_id' => $this->session->userdata("usuario_id")
			];

			$serviciofinalizado_id = $this->modelo->modelo->add($dataServicioFinalizado);
			//guardar detalles
			if($serviciofinalizado_id != false){
				for($i=0; $i < count($data); $i++){
					$arr_temp = 	[
								'serviciosfinalizados_id' => $serviciofinalizado_id,
								'n_linea' => ($i+1),
								'cantidad' => $data[$i][1],
								'valor'	=> $data[$i][2]
					];
				
					$this->modelo->addDetalle($arr_temp);
				}

			}
			$response = [
							'codigo' => 1,
							'response' => 'Se ha generado de manera correcta el Cierre de Servicio.'
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
	public function editServicioFinalizado(){
		$serviciofinalizado_id = trim($this->input->post('serviciofinalizado_id', TRUE));

		$data = $this->input->post('data', TRUE);

		$usuario = trim($this->input->post('usuario', TRUE));
		$ticket = trim($this->input->post('ticket', TRUE));
		$istt = trim($this->input->post('istt', TRUE));
		$fecha = trim($this->input->post('fecha', TRUE));
		$servicio = trim($this->input->post('servicio', TRUE));
		$cliente = trim($this->input->post('cliente', TRUE));
        $valor = trim($this->input->post('valor', TRUE));
		$descripcion = trim($this->input->post('descripcion', TRUE));
		$nota_venta = trim($this->input->post('nota_venta', TRUE));
		$orden_compra = trim($this->input->post('orden_compra', TRUE));
		$factura = trim($this->input->post('factura', TRUE));
		$iva_historico = trim($this->input->post('iva_historico', TRUE));
		$iva = trim($this->input->post('iva', TRUE));
		$total = trim($this->input->post('total', TRUE));


		$response = [];
		if(!empty($istt) && !empty($fecha) && !empty($servicio) && !empty($cliente) && 
			!empty($valor)){
			//guardar serviciofinalizado
			$dataServicioFinalizado = 	[
									'ticket' => $ticket,
									'istt' => $istt,
									'fecha_creacion' => date('Y-m-d H:i:s'),
									'fecha_actualizacion' => date('Y-m-d H:i:s'),
									'fecha' => $fecha,
									'titulo' => $titulo,
									'clientes_id' => $cliente,
									'descripcion' => $descripcion,
									'nota_vena' => $nota_venta,
									'orden_compra' => $orden_compra,
									'factura' => $factura,
									'iva_historico' => $iva_historico,
									'total' => $total,
									'iva'	=>	$iva,
									'usuarios_id' => $this->session->userdata("usuario_id")
								];
			
			$this->modelo->modelo->edit($dataServicioFinalizado, $serviciofinalizado_id);
			//eliminar detalles
			$this->modelo->deleteDetalleServicioFinalizado($serviciofinalizado_id);
			//guardar detalles
			if(count($data) > 0){
				for($i=0; $i < count($data); $i++){
					$arr_temp = 	[
										'serviciosfinalizados_id' => $serviciofinalizado_id,
										'n_linea' => ($i+1),
										'cantidad' => $data[$i][1],
										'valor'	=> $data[$i][2]
					];
					$this->modelo->addDetallePre($arr_temp);
				}
			}
			

			$response = [
				'codigo' => 1,
				'response' => 'Se ha editado de manera correcta el Cierre de Servicio.'
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
		$crud->set_table('serviciosfinalizados');
		$crud->set_subject('Usuario');
		$crud->set_language('spanish');

		$crud->set_relation('clientes_id','clientes','razonsocial');
		$crud->display_as('clientes_id','Cliente');
		$crud->display_as('total','Total P.');
		$crud->display_as('total_real','Total R.');
		$crud->display_as('fecha_creacion','creado');
		$crud->columns(['codigo','fecha','titulo','total','total_real', 'clientes_id', 'fecha_creacion']);
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
		$data['titulo'] = 'ServiciosFinalizados Historico';
		$this->load->view('serviciosfinalizados/historico', $data);
	}
}