<?php 
/*
 *	https://www.youtube.com/watch?v=8pNIVWUyJDg
 sendmesseger http://wpavanzado.com/3-plugins-google-analytics-wordpress/
 */
class panel extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->database('default');
	    $this->load->library( 'session' );
	    $this->load->library( 'MY_Session' );
	    $this->load->library('Myfunction');
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->model('panel_model');
	    $this->load->model('usermanager');
	}
	public function index($id = false){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
 		$data['alert'] = false;
		$data['tarea'] = null;
			//$data['import'] = $this->input->get('import');
			$data['horas'] = array(0 => array('value' => '09', 'hora' => '9:00'),
					       1 => array('value' => '10', 'hora' => '10:00'),
					       2 => array('value' => '11', 'hora' => '11:00'),
					       3 => array('value' => '12', 'hora' => '12:00'),
					       4 => array('value' => '13', 'hora' => '13:00'),
					       5 => array('value' => '14', 'hora' => '14:00'),
					       6 => array('value' => '15', 'hora' => '15:00'),
					       7 => array('value' => '16', 'hora' => '16:00'),
					       8 => array('value' => '17', 'hora' => '17:00'));
		if($id){
			$data['tarea'] = $this->panel_model->getTarea($id);
		}
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/home',$data);
		$this->load->view('panel/footer');
		
	}
	
	public function respuesta(){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
 		$data['alert'] = false;
		
		$data['tel'] = $this->input->get('telefono');
		$datos = $this->panel_model->getHistory($data['tel']);
		$datos = json_decode(json_encode($datos),true);
		$data['historial'] = $this->myfunction->orderMultiDimensionalArray ($datos, "fecha", $inverse = true);
		
		
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/respuesta',$data);
		$this->load->view('panel/footer');
		
	}

	public function report(){
		$value = $this->session->userdata('nombre');
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		if(!$value){
			redirect('login');
		}
		$data['fecha_init'] = date('Y-m-d');
		$data['fecha_end'] = date('Y-m-d');
		$data['result'] = null;
		$data['msj'] = null;
		$data['export'] = false;
		$data['users'] = $this->usermanager->getUsers();
		$data['user_id'] = $header['user_id'] = $this->session->userdata('user_id');
		if($data['fecha_init'] != null && $data['fecha_end'] != null){
			if(strtotime($data['fecha_end']) >= strtotime($data['fecha_init'])){
				$data['fecha_init'] = $buscar['fecha_init'] = $this->input->get('fecha_init');
				$data['fecha_end'] = $buscar['fecha_end'] = $this->input->get('fecha_end');
				$user = $this->input->get('user');
				if($this->session->userdata('user_id') > 1)
					$buscar['user_id'] = $this->session->userdata('user_id');
					
				if($user)
					$buscar['user_id'] = $user;
				$data['result'] = $this->panel_model->getMensajes($buscar);
				if($data['result']){
					$data['export'] = true;
				}
				$ok = true;
				
			}else{
				$ok = false;
				
				$data['fecha_init'] = date('Y-m-d');
				$data['fecha_end'] = date('Y-m-d');
				$data['msj'] = "Rangos de fechas incorrectos";
				
			}
		}else{
			$data['msj'] = "No selecciono ninguna fecha";
		}
		
		
		
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/historial',$data);
		$this->load->view('panel/footer');
		
	}
	
	
	public function reportind($id){
		$value = $this->session->userdata('nombre');
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		if(!$value){
			redirect('login');
		}
		$data['id'] = $id;
		$data['result'] = $this->panel_model->getMensajesInd($id);
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/detalle',$data);
		$this->load->view('panel/footer');
		
	}
	public function tasks(){
		$value = $this->session->userdata('nombre');
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		if(!$value){
			redirect('login');
		}
		$data['result'] = $this->panel_model->getTareas();
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/tareas',$data);
		$this->load->view('panel/footer');
		
	}
	public function taskdelete($id){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
		if($id){
			$this->panel_model->deleteTareas($id);
			echo true;
		}else{
			echo 'error';
		}
		
		
	}
	
	
	public function exportrone(){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
		$fecha_end =  $this->input->get('fecha_end');
		$fecha_init = $this->input->get('fecha_init');
			if(strtotime($fecha_end) >= strtotime($fecha_init)){
				$buscar['fecha_init'] = $this->input->get('fecha_init');
				$buscar['fecha_end'] = $this->input->get('fecha_end');
				
				$user = $this->input->get('user');
				if($this->session->userdata('user_id') > 1)
					$buscar['user_id'] = $this->session->userdata('user_id');
				
				if($user)
					$buscar['user_id'] = $user;
				
				$result = $this->panel_model->getMensajes($buscar);
				

				$this->load->library('excel');
 
					//algunos datos sobre autoría
					$this->excel->getProperties()->setCreator("Clicktools");
					$this->excel->getProperties()->setLastModifiedBy("root");
					$this->excel->getProperties()->setTitle("XLSX Reporte");
					$this->excel->getProperties()->setSubject("XLSX Reporte");
					$this->excel->getProperties()->setDescription("Reporte para Office 2007 XLSX, Usando PHPExcel.");
					//Trabajamos con la hoja activa principal
					$this->excel->setActiveSheetIndex(0);
							$titulosColumnas = array('Numero de mensajes', 'Mensajes', 'Enviados', 'Fallidos','Total','% enviados', 'Fecha','Usuario');	
							// Se agregan los titulos del reporte
							$this->excel->setActiveSheetIndex(0)
								    ->setCellValue('A1',  $titulosColumnas[0])
								    ->setCellValue('B1',  $titulosColumnas[1])
								    ->setCellValue('C1',  $titulosColumnas[2])
								    ->setCellValue('D1',  $titulosColumnas[3])
								    ->setCellValue('E1',  $titulosColumnas[4])
								    ->setCellValue('F1',  $titulosColumnas[5])
								    ->setCellValue('G1',  $titulosColumnas[6])
								    ->setCellValue('H1',  $titulosColumnas[7]);
					 $i = 2;
					foreach($result as $row){
					    $this->excel->getActiveSheet()->SetCellValue("A". $i, $row->numbers);
					    $this->excel->getActiveSheet()->SetCellValue("B". $i, $row->mensaje);
					    $this->excel->getActiveSheet()->SetCellValue("C". $i, $row->enviados);
					    $this->excel->getActiveSheet()->SetCellValue("D". $i, ($row->total - $row->enviados));
					    $this->excel->getActiveSheet()->SetCellValue("E". $i, $row->total);
					    $this->excel->getActiveSheet()->SetCellValue("F". $i, $this->myfunction->porcentaje(($row->total - $row->enviados), $row->total));
					    $this->excel->getActiveSheet()->SetCellValue("G". $i, substr($row->fecha,0,10));
					    $this->excel->getActiveSheet()->SetCellValue("H". $i, $row->username);
					    $i++;
					}
					 
					//Titulo del libro y seguridad 
					$this->excel->getActiveSheet()->setTitle('Reporte');
					$this->excel->getSecurity()->setLockWindows(true);
					$this->excel->getSecurity()->setLockStructure(true);
					 
					 $obj = $this->excel;
					// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
					$this->excel->stream("reporte.xlsx",$obj);
					return true;
				
			}else{
				echo 'error';
			}
	}
	public function exportrdos($id){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
				$result = $this->panel_model->getMensajesInd($id);
				$this->load->library('excel');
					//algunos datos sobre autoría
					$this->excel->getProperties()->setCreator("Clicktools");
					$this->excel->getProperties()->setLastModifiedBy("root");
					$this->excel->getProperties()->setTitle("XLSX Reporte");
					$this->excel->getProperties()->setSubject("XLSX Reporte");
					$this->excel->getProperties()->setDescription("Reporte para Office 2007 XLSX, Usando PHPExcel.");
					//Trabajamos con la hoja activa principal
					$this->excel->setActiveSheetIndex(0);
							$titulosColumnas = array('Telefono', 'Mensaje', 'Estado');	
							// Se agregan los titulos del reporte
							$this->excel->setActiveSheetIndex(0)
								    ->setCellValue('A1',  $titulosColumnas[0])
								    ->setCellValue('B1',  $titulosColumnas[1])
								    ->setCellValue('C1',  $titulosColumnas[2]);
					 $i = 2;
					foreach($result as $row){
					    $this->excel->getActiveSheet()->SetCellValue("A". $i, $row->telefono);
					    $this->excel->getActiveSheet()->SetCellValue("B". $i, $row->mensaje);
					    $this->excel->getActiveSheet()->SetCellValue("C". $i, $row->estado);
					    $i++;
					}
					 
					//Titulo del libro y seguridad 
					$this->excel->getActiveSheet()->setTitle('Reporte');
					$this->excel->getSecurity()->setLockWindows(true);
					$this->excel->getSecurity()->setLockStructure(true);
					 
					 $obj = $this->excel;
					// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
					$this->excel->stream("reporte.xlsx",$obj);
					return true;
				
	}
	/*
	 *	Sugerencias
	 */
	public function s(){
		$value = $this->session->userdata('nombre');
		if(!$value){
			redirect('login');
		}
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		
		$data['ok'] = false;
		$this->form_validation->set_rules('asunto', 'Numeros', 'required');
		$this->form_validation->set_rules('mensaje', 'Mensajes', 'required');
		if ($this->form_validation->run() == true){
			$datos['asunto'] = $this->input->post('asunto');
			$datos['mensaje'] = $this->input->post('mensaje');
			$datos['estado'] = "Pendiente";	
			$this->panel_model->setSugerencias($datos);
			$data['ok'] = true;
		}
		$data['mensajes'] = $this->panel_model->getSugerencias();
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/sugerencias',$data);
		$this->load->view('panel/footer');
	}

	public function excel(){
		$info = $this->uploadfile();
		if($info['upload_data']['file_name'] != ""){
			$file = $info['upload_data']['file_name'];
			$array = "";
			$value = "";
			$status =  true;
			//load the excel library
			$this->load->library('excel');
			$objPHPExcel = PHPExcel_IOFactory::load(FCPATH . 'upload/' . $file);
			$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			if($objHoja[1]['A'] != null){
				foreach ($objHoja as $iIndice=>$objCelda) {
					if($objCelda['A'] != null){
						//if(strlen($objCelda['A']) == 8){
							$array .= $objCelda['A'] . ",";
						//}
					}
					if(isset($objCelda['B']) && $objCelda['B'] != null){
							$array .= $objCelda['B'] . ",";
					}else{
						$array .= "0,";
					}
					if(isset($objCelda['C']) && $objCelda['C'] != null){
							$array .= $objCelda['C'] . ",";
					}else{
						$array .= "0,";
					}
					if(isset($objCelda['D']) && $objCelda['D'] != null){
							$array .= $objCelda['D'];
					}else{
						$array .= "0";
					}
					$array .= ";";
				}
				if($array != null){
					$value = substr($array, 0, -1);
				}else{
					$status = false;
					$value = "Error no se encontro ningun numero de telefono,
						verifica que los numeros esten escritos correctamente";
				}
				
				//var_dump($array);
			}else{
				$status = false;
				$value = "Error el archivo se encuentra vacio o se no encuentra escrito correctamente.";
			}
			//foreach ($objHoja as $iIndice=>$objCelda) {
			//	$array[] = $objCelda['A'] ;
			//}
			 //var_dump($objHoja[1]['A']);
			//send the data in an array format
			//$data['header'] = $header;
			//var_dump($header);
			//$data['values'] = $arr_data;
			unlink(FCPATH . 'upload/' . $file);
		}else{
			$status = false;
			$value = "Error el archivo no fue subido correctamente, verfique si es un archivo de excel.";
		}
		echo json_encode(array('value' => $value, 'status' => $status));
	}
	public function uploadfile()
		{
		    		$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'xlsx|xls';
				$config['max_size']	= '500';
				$config['max_width']  = '2000';
				$config['max_height']  = '1024';
		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload()){
				return false; 
			}else{
				return $data = array('upload_data' => $this->upload->data());
				echo 'funciona';
			}
		}
	/*
	 *	Nuevos cambios
	 */
	public function notify(){
		$value = $this->session->userdata('nombre');
		$header['user'] = $value;
		$header['user_id'] = $this->session->userdata('user_id');
		$header['total'] = $this->panel_model->getTotalMsj($header['user_id']);
		$header['total_msj'] = $this->panel_model->getNotifyActive();
		if(!$value){
			redirect('login');
		}
		/*
		 * configuraciones globales
		 */
		
		$data['result'] = $this->panel_model->getNotify();
		$this->load->view('panel/header',$header);
		$this->load->view('panel/sub/notify',$data);
		$this->load->view('panel/footer');
	}
}
